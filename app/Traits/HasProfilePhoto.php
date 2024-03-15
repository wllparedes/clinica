<?php

namespace App\Traits;

use App\Services\FileService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use Laravel\Jetstream\Features;

trait HasProfilePhoto
{

    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    // public function deleteProfilePhoto()
    // {

    //     $storage = env('FILESYSTEM_DISK');

    //     $user = Auth::user();

    //     $this->fileService->destroy($user->avatar(), $storage);

    // }
}
