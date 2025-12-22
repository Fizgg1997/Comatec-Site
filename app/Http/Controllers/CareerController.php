<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CareerRequest;
use App\Career;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CareerController extends Controller
{
    public function submit(CareerRequest $request) {
        $date = \Carbon\Carbon::now();
        $file_name = $request->file->getClientOriginalName();
        $path = 'careers/' . $date->format('F').$date->format('Y');
        $fileName = Str::random(40) . '.' . $request->file->getClientOriginalExtension();
        $path = $request->file->storeAs($path, $fileName, 'public');

        Storage::disk('public')->put($path, $file_name);
        $fileInfo = json_encode([
            'download_link' => $path,
            'original_name' => $file_name,
        ]);

        Career::create([
            'name' => $request->name,
            'mobile_number' => $request->mobile_number,
            'email' => $request->email,
            'message' => $request->message,
            'file' => $fileInfo
        ]);

        return redirect('career')->with('status', 'Your Application sent Successfully');
    }
}
