<?php

namespace App\Services;

class FileService
{
    /*
    |--------------------------------------------------------------------------
    | OLD METHODS — purane code ke liye (return: path + filename dono)
    | Inhe mat chhedo, purana sara code inhi par depend karta hai
    |--------------------------------------------------------------------------
    */

    public static function upload($file, $path)
    {
        if (!$file) return null;

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($path), $fileName);

        return $path . '/' . $fileName; // poora relative path
    }

    public static function update($file, $path, $oldFile = null)
    {
        if (!$file) return $oldFile;

        if ($oldFile && file_exists(public_path($oldFile))) {
            unlink(public_path($oldFile));
        }

        return self::upload($file, $path);
    }

    public static function delete($filePath)
    {
        if ($filePath && file_exists(public_path($filePath))) {
            unlink(public_path($filePath));
            return true;
        }

        return false;
    }


    /*
    |--------------------------------------------------------------------------
    | NEW METHODS — naye code ke liye (return: sirf filename)
    | Path alag se helper functions (payroll_*_dir) se milega
    |--------------------------------------------------------------------------
    */

    // public static function uploadFile($file, $path)
    // {
    //     if (!$file) return null;

    //     $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
    //     $file->move(public_path($path), $fileName);

    //     return $fileName; // sirf filename
    // }

    // public static function updateFile($file, $path, $oldFileName = null)
    // {
    //     if (!$file) return $oldFileName;

    //     if ($oldFileName && file_exists(public_path($path . '/' . $oldFileName))) {
    //         unlink(public_path($path . '/' . $oldFileName));
    //     }

    //     return self::uploadFile($file, $path);
    // }

    // public static function deleteFile($path, $fileName)
    // {
    //     if (!$fileName) return false;

    //     $fullPath = $path . '/' . $fileName;

    //     if (file_exists(public_path($fullPath))) {
    //         unlink(public_path($fullPath));
    //         return true;
    //     }

    //     return false;
    // }
}
