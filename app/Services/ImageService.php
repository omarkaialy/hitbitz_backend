<?php

namespace App\Services;

class ImageService
{

    public function storeImage($model, $image, $collection)
    {
        try {
            if (!isset($image)) return;
            if (str_contains($image, config('app.url'))) {
                $image = str_replace(config('app.url'), '', $image);
                $hash = \Bepsvpt\Blurhash\Facades\BlurHash::encode(public_path('images/temp') . '/' . $image);


                $mediaModel = $model->addMedia(public_path('images/temp') . '/' . $image)->preservingOriginal()->toMediaCollection($collection);

            } else {
                $hash = \Bepsvpt\Blurhash\Facades\BlurHash::encode(public_path('images/temp') . '/' . $image);

                $mediaModel = $model->addMedia(public_path('images/temp') . '/' . $image)->preservingOriginal()->toMediaCollection($collection);
            }
            $mediaModel->setCustomProperty('hash' , $hash);
            $mediaModel->save();
        } catch (Exception $e) {
            throw $e;
        }


    }

}
