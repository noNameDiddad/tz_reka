<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileManager
{
    /**
     * Make preview by file
     *
     * @param $path
     * @return string
     */
    public static function makePreview($path): string
    {
        return $path; //TODO Прописать реализацию makePreview
    }

    /**
     * Delete file with preview
     *
     * @param $file
     * @return void
     */
    public static function deleteFileWithPreview($file): void
    {
        if (Storage::exists('/public/' . $file->path)) {
            Storage::delete('/public/' . $file->path);
        }
        if (Storage::exists('/public/' . $file->preview_path)) {
            Storage::delete('/public/' . $file->preview_path);
        }
    }

}
