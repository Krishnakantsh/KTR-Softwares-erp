<?php

namespace App\Services;

class FileService
{

    public static function upload($file, $path)
    {
        if (!$file) return null;

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        
        $file->move(public_path($path), $fileName);

        return $path . '/' . $fileName;
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
}
