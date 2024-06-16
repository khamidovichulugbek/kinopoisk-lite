<?php


namespace App\Kernel\Upload;


class UploadFile implements UploadFileInterface
{
    public function __construct(
        public readonly string $name,
        public readonly string $type,
        public readonly string $tmpName,
        public readonly int $error,
        public readonly int $size,
    )
    {
        
    }

    public function move(string $path, string $fileName = null): string|false{
        $storagePath = APP_PATH . "/public/assets/storage/$path";
        if (!is_dir($storagePath)){
            mkdir($storagePath, 0777, true);

        }

        $fileName = $fileName ?? $this->randomFileName();

        $filePath = "$storagePath/$fileName";

        if (move_uploaded_file($this->tmpName, $filePath)){
            return "$path/$fileName";
        }

        return false;
    }

    private function randomFileName(){
        return md5(uniqid(rand(), true)) . ".{$this->getExtension()}";
    }

    public function getExtension(): string
    {
        return pathinfo($this->name, PATHINFO_EXTENSION);
    }

    public function hasError(): bool
    {
        return $this->error !== UPLOAD_ERR_OK;
    }
}
