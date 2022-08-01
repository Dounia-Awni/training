<?php

namespace App\libraries;

use Illuminate\Support\Facades\Storage;

class Helper{

public static function uploadImage($path)    
    {
        $data = null;
        try {
            if (isset($path)) {
                $name = $path->getClientOriginalName();
                $name = preg_replace("/\s+/", "", $name);
                $storage = Storage::disk('s3');
                $storage->makeDirectory('media');
                $files = $storage->put('media', $path, [
                    'mimetype' => 'png/jpg'
                ]);
                $storage->setVisibility($files, 'public');
                $upload = $storage->url($files);
                $data = ['path' => $upload, 'name' => $name];
            }
        } catch (\Exception $exception) {
            Log::error('Helper' . $exception->getMessage());
        }
        return $data;
    }
}