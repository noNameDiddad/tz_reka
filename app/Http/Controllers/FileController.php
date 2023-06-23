<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Task;
use App\Services\FileManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Task $task
     * @param FileManager $fileManager
     * @return Model
     */
    public function store(Request $request, Task $task, FileManager $fileManager): Model
    {
        $uploaded_file = $request->file('uploaded_file');
        $path = $fileManager->saveUploadFile($uploaded_file);
        return $task->files()->create($fileManager->makeFile($uploaded_file,$path));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param File $file
     * @param FileManager $fileManager
     * @return bool
     */
    public function update(Request $request, File $file, FileManager $fileManager): bool
    {
        $uploaded_file = $request->file('uploaded_file');
        $path = $fileManager->saveUploadFile($uploaded_file);
        $fileManager->deleteFileWithPreview($file);

        return $file->update($fileManager->makeFile($uploaded_file,$path));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param File $file
     * @param FileManager $fileManager
     * @return bool
     */
    public function destroy(File $file,  FileManager $fileManager): bool
    {
        $fileManager->deleteFileWithPreview($file);
        return $file->delete();
    }
}
