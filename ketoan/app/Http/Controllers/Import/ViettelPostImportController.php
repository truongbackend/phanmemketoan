<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportDataRequest;
use Illuminate\Http\Request;

class ViettelPostImportController extends Controller
{
    public function importData(ImportDataRequest $request)
    { 
        dd(123);

        // Validate the request data
        $validated = $request->validated();
        // Process the uploaded files
        dd($validated);
        return response()->json(['message' => 'File imported successfully'], 200);
    }
}
