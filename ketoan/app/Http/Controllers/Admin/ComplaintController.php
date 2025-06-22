<?php

namespace App\Http\Controllers\Admin;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $complaints = Complaint::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
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
        return response()->json($complaint);
    }
    public function update(Request $request, Complaint $complaint)
    {
        // Chỉ admin mới được update status (giả sử có gate/role)
        $this->authorize('update', $complaint);

        $data = $request->validate([
            'status' => ['required', Rule::in(['new','in_review','resolved'])],
        ]);

        $complaint->update($data);

        return response()->json($complaint);
    }
}
