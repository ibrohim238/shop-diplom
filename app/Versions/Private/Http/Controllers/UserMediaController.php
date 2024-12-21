<?php

namespace App\Versions\Private\Http\Controllers;

use app\Http\Resources\MediaResource;
use App\Versions\Private\Dtos\UserMediaDto;
use App\Versions\Private\Http\Requests\UserMediaRequest;
use App\Versions\Private\Services\UserMediaService;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final readonly class UserMediaController
{
    public function index(Request $request)
    {
        $medias = $request->user()
            ->media()
            ->paginate($request->get('limit', 15));

        return MediaResource::collection($medias);
    }

    public function store(UserMediaRequest $request)
    {
        $user = $request->user();

        $media = UserMediaService::store($user, UserMediaDto::fromRequest($request));

        return MediaResource::make($media);
    }

    public function destroy(Media $media)
    {
        app(UserMediaService::class, [
            'media' => $media,
        ])
            ->delete($media);

        return response()->noContent();
    }
}
