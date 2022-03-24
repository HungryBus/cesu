<?php

namespace App\Http\Services\Image;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

class ImageService
{
    public function upload(UploadedFile $file, Model $model): Image
    {
        $path = '/documents';

        $file = $this->store($file, $path);

        $image = new Image();
        $image->filename = $file->getPathname();
        $image->imageable_type = get_class($model);
        $image->imageable_id = $model->id;

        $image->save();

        return $image;
    }

    private function store(UploadedFile $file, string $path): File
    {
        $ext = $file->extension();
        $filename = sha1(time() . generateSalt()) . '.' . $ext;
        $directory = 'uploads' . $path;

        $file = $file->move($directory, $filename);

        return $file;
    }
}
