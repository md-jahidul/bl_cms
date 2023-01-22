<?php

/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/20/19
 * Time: 12:13 PM
 */

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait FileTrait {

    protected $disk = 'internal';

    /**
     * Uplaod a file
     * @param file - The file instance
     * @param directoryPath - Directory path relative to base upload path
     * @return file path
     */
    protected function upload($file, $directoryPath, $fileName = "")
    {
        if ($fileName != "") {
            $path = $file->storeAs(
                $directoryPath,
                $fileName,
                $this->disk
            );
        } else {
            $path = $file->store(
                $directoryPath,
                $this->disk
            );
        }

        return $path;
    }

    protected function uploadOrgFileName($file, $directoryPath, $fileName)
    {
        $path = $file->storeAs(
            $directoryPath,
            $fileName,
            $this->disk
        );
        return $path;
    }

    /**
     * Rename after upload
     * @param file name
     * @param directoryPath - Directory path relative to base upload path
     * @return string path
     * @Dev Bulbul Mahmud Nito || 30/03/2020
     */
    protected function rename($path, $fileName, $directoryPath)
    {
        $oldImg = env('UPLOAD_BASE_PATH') . "/" . $path;

        $pathToArray = explode('/', $path);
        $imgName = end($pathToArray);
        $mimeArray = explode('.', $imgName);
        $mime = end($mimeArray);
        $newName = $directoryPath . "/" . $fileName . "." . $mime;
        $newPath = env('UPLOAD_BASE_PATH') . "/" . $newName;
        rename($oldImg, $newPath);
        return $newName;
    }

    /**
     * Download the attachments
     * @param filePath full file path including folder name and file name with extension relative to base path
     * @param displayName name of the downloaded file
     * @return file
     */
    protected function download($filePath, $displayName) {
        return Storage::disk($this->disk)->download($filePath, $displayName);
    }

    /**
     * View the file in browser like image or pdf
     * @param filePath full file path including folder name and file name with extension relative to base path
     * @return file
     */
    protected function view($filePath) {
        $headers = array(
            'Content-Disposition' => 'inline',
        );
        return Storage::disk($this->disk)->download($filePath, 'file-name', $headers);
    }

    /**
     * @param filePath full file path including folder name and file name with extension relative to base path
     * @return bool
     */
    protected function deleteFile($filePath) {
        return Storage::disk($this->disk)->delete($filePath);
    }

    public function getPath($fileName)
    {
        return Storage::disk($this->disk)->path($fileName);
    }

}
