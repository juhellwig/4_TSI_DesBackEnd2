<?php

namespace App\Services;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UserUploadService
{
    private static string $path = 'usuarios';

    public static function handleUploadFile(UploadedFile $image): array
    {
        $hashFilename = $image->hashName();

        $result = Storage::putFile(self::$path, $image);

        if (!$result) {
            throw new Exception("Erro ao salvar imagem do usuário");
        }

        $public_id = self::$path . '/' . $hashFilename;
        $url = Storage::url($public_id);

        if (!$url) {
            throw new Exception("Erro ao gerar URL da imagem no Cloudinary");
        }

        return [
            'url' => $url,
            'public_id' => $public_id
        ];
    }
}
