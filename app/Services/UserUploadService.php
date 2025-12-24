<?php

namespace App\Services;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class UserUploadService
{
    private static string $path = 'usuarios';

    public static function handleUploadFile(UploadedFile $image): array
    {
        $filename = $image->hashName();

        $result = Storage::putFileAs(self::$path, $image, $filename);

        if (!$result) {
            throw new Exception("Erro ao salvar imagem do usuário");
        }

        $public_id = self::$path . '/' . $filename;
        $url = Storage::url($public_id);

        if (!$url) {
            throw new Exception("Erro ao gerar URL da imagem no Cloudinary");
        }

        return [
            'url' => $url,
            'public_id' => $public_id
        ];
    }

    public static function delete(string $publicId): void
    {
        Cloudinary::destroy($publicId);
    }
}
