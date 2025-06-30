<?php

namespace App\Http\Controllers\Admin;

use \Log;
use App\Http\Controllers\Controller;
use App\Mail\ComplaintNotificationMail;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);

        $query = Complaint::with('user')
            ->orderBy('created_at', 'desc');
        $isAdmin = Auth::user()
            ->roles()
            ->where('name', 'administration')
            ->exists();

        if (! $isAdmin) {
            $query->where('user_id', Auth::id());
        }

        $complaints = $query->paginate($perPage);

        return response()->json($complaints);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'order_code' => 'nullable|string|max:50',
            'content'    => 'required|string',
        ]);

        $data['user_id'] = Auth::id();

        $complaint = Complaint::create($data);
        try {
            $admins = ['info@pnl-international.com', 'trongfrontend@gmail.com'];
            Mail::to($admins)->send(new ComplaintNotificationMail($complaint));
        } catch (\Exception $e) {
            Log::error('Lỗi gửi email khiếu nại: '.$e->getMessage());
        }

        return response()->json($complaint);
    }
    public function update(Request $request, Complaint $complaint)
    {
        $data = $request->validate([
        'order_code' => ['sometimes','nullable','string','max:50'],
        'content'    => ['sometimes','string'],
        'status'     => ['sometimes', Rule::in(['new','in_review','resolved'])],
    ]);

    $complaint->update($data);

        return response()->json($complaint);
    }
     public function show(Complaint $complaint)
    {
        $complaint->load('user');
        return response()->json($complaint);
    }
    public function destroy(Complaint $complaint)
    {
        $complaint->delete();
        return response()->json([
            'message' => 'Xoá khiếu nại thành công'
        ], 204);
    }
}
