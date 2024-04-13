<?php

namespace App\Http\Resources;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaResource
{


    public static function make($model, $collection = null,$hasDefault=true): array
    {
        if ($model instanceof Media){
            return [
                'id'                => $model->id,
                'media_url'         => $model->getUrl(),
                'hash'              => $model->getCustomProperty('hash'),
                'order'             => $model->order_column,
            ];
        }

        $media = $model->getFirstMedia($collection);

        if (!isset($media) ) {
            if ($hasDefault)
            return self::defaultMedia($model, $collection);
        else
            return [];
        }

        return [
            'id'                => $media->id,
            'media_url'         => $media->getUrl(),
            'hash'              => $media->getCustomProperty('hash'),
            'order'             => $media->order_column,
        ];
    }

    public static function collection($model, $collection): array
    {

        $medias = $model->getMedia($collection);
        if ($medias->isEmpty()) {
            return [self::defaultMedia($model, $collection)];
        }
        $result = [];
        foreach ($medias as $media) {
            $result[] = [
                'id'                => $media->id,
                'media_url'         => $media->getUrl(),
                'hash'              => $media->getCustomProperty('hash'),
                'order'             => $media->order_column,
            ];
        }
        return $result;
    }

    public static function defaultMedia($model, $collection)
    {
        return [
//             'id'                => null,
            'media_url'         => config('app.url') . '/storage/' . 'default.jpg',
            'hash'              => 'KGGc.IRk1k?]fP%MC9t6-U',
//             'order'             => null,
        ];
    }
}
