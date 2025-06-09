<?php

namespace App\Http\Controllers\Admin;

use App\Models\package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class packageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Package::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        return response()->json($query->get());
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $messages = [
        'name.unique' => 'Tên gói đã tồn tại, vui lòng chọn tên khác.',
    ];

    $validator = Validator::make($request->all(), [
        'name' => 'required|unique:packages,name',
    ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $package = Package::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'discould' => $request->input('discould'),
            'expiration_time' => $request->input('expiration_time'),
            'note' => $request->input('note'),
            'status' => $request->input('status', 1),
        ]);

        return response()->json($package, 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::find($id);
        return response()->json($package, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'name.unique' => 'Tên gói đã tồn tại, vui lòng chọn tên khác.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:packages,name,' . $id,
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $package = Package::findOrFail($id);
        $package->name = $request->name;
        $package->price = $request->price;
        $package->discould = $request->discould;
        $package->expiration_time = $request->expiration_time;
        $package->note = $request->note;
        $package->save();
        return response()->json(['message' => 'Cập nhật thành công']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Package::where('id', $id)->delete();
        return response()->json('Xoá thành công');
    }
}
