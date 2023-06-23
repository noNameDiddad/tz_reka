<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileManager
{

    public function makeFile($file, string $path): array
    {
        return [
            'path' => $path,
            'name' => $file->getClientOriginalName(),
            'preview_path' => FileManager::makePreview($path),
            'filetype' => $file->getClientMimeType(),
        ];
    }

    public function saveUploadFile($file): string
    {
        return $file->store('files/' . now()->format('d-m-Y'), 'public');
    }


    /**
     * Make preview by file
     *
     * @param $path
     * @return string
     */
    public function makePreview(string $path): string
    {
        return $path; //TODO Прописать реализацию makePreview
    }

    /**
     * Delete file with preview
     *
     * @param File $file
     * @return void
     */
    public function deleteFileWithPreview(File $file): void
    {
        if (Storage::exists('/public/' . $file->path)) {
            Storage::delete('/public/' . $file->path);
        }
        if (Storage::exists('/public/' . $file->preview_path)) {
            Storage::delete('/public/' . $file->preview_path);
        }
    }

}
