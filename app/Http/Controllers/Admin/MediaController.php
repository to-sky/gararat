<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\Models\Media;

class MediaController extends Controller
{
    /**
     * Delete image
     *
     * @param Media $media
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Media $media)
    {
        return $media->delete()
            ? response('OK', '204')
            : response('Bad Request', '400');
    }
}
