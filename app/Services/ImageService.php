<?php

namespace App\Services;

use Bepsvpt\Blurhash\Facades\BlurHash;

class ImageService
{

    public function storeImage($model, $image, $collection)
    {
        try {
            if (!isset($image)) return;
           else if (str_contains($image, config('app.url'))) {
                $image = str_replace(config('app.url'), '', $image);
                $hash = BlurHash::encode(storage_path('images\\temp\\')  . $image);


                $mediaModel = $model->addMedia(storage_path('images\\temp\\')  . $image)->preservingOriginal()->toMediaCollection($collection);

            } else {
                $hash = BlurHash::encode(storage_path('images\\temp\\') . $image);

                $mediaModel = $model->addMedia(storage_path('images\\temp\\')  . $image)->preservingOriginal()->toMediaCollection($collection);
            }
            $mediaModel->setCustomProperty('hash', $hash);
            $mediaModel->save();
        } catch (Exception $e) {
            throw $e;
        }


    }

}
