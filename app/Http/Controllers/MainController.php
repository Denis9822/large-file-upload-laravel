<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Http\Resources\UploadFileResource;
use App\Http\Services\FileUpload;
use Illuminate\View\View;

class MainController extends Controller
{
    public function __construct(private readonly FileUpload $fileUpload)
    {}

    public function index(): View
    {
        return view('index');
    }

    public function fileUpload(FileRequest $request): UploadFileResource
    {
        $attributes = $request->validated();

        $this->fileUpload->upload($attributes);

        return new UploadFileResource($attributes);
    }
}
