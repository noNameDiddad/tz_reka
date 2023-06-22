<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $uploaded_file = $request->file('uploaded_file');
        return File::create([
            'path' => $uploaded_file->store('files/' . now()->format('d-m-Y'), 'public'),
            'name' => $uploaded_file->getClientOriginalName(),
            'preview_path' => '',
            'filetype' => $uploaded_file->getClientMimeType(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param File $file
     * @return bool
     */
    public function update(Request $request, File $file): bool
    {
        $uploaded_file = $request->file('uploaded_file');
        $path = $uploaded_file->store('files/' . now()->format('d-m-Y'), 'public');
        if (Storage::exists('/public/' . $file->path)) {
            Storage::delete('/public/' . $file->path);
        }
        return $file->update([
            'path' => $path,
            'name' => $uploaded_file->getClientOriginalName(),
            'preview_path' => '',
            'filetype' => $uploaded_file->getClientMimeType(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param File $file
     * @return bool
     */
    public function destroy(File $file): bool
    {
        if (Storage::exists('/public/' . $file->path)) {
            Storage::delete('/public/' . $file->path);
        }
        return $file->delete();
    }
}
