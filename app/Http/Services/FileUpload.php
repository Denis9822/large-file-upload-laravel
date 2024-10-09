<?php

namespace App\Http\Services;

class FileUpload
{
    public function upload(array $attributes)
    {
        $tempDir = storage_path('app/public/uploads/');
        $tempFilePath = $tempDir.$attributes['fileName'].'.part';

        if (! is_dir($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        $file = fopen($tempFilePath, 'ab');
        fwrite($file, file_get_contents($attributes['file']->getRealPath()));
        fclose($file);

        if ($attributes['chunkNumber'] == $attributes['totalChunks'] - 1) {
            $finalFilePath = storage_path('app/public/uploads/').$attributes['fileName'];
            rename($tempFilePath, $finalFilePath);
        }

        return $attributes['chunkNumber'];
    }
}
