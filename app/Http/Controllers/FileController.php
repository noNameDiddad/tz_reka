<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Services\FileManager;
use Illuminate\Http\Request;

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
        $path = $uploaded_file->store('files/' . now()->format('d-m-Y'), 'public');
        return File::create([
            'path' => $path,
            'name' => $uploaded_file->getClientOriginalName(),
            'preview_path' => FileManager::makePreview($path),
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
        FileManager::deleteFileWithPreview($file);

        return $file->update([
            'path' => $path,
            'name' => $uploaded_file->getClientOriginalName(),
            'preview_path' => FileManager::makePreview($path),
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
        FileManager::deleteFileWithPreview($file);
        return $file->delete();
    }
}
