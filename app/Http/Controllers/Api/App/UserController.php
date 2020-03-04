<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Transformers\Api\App\UserTransformer;
use Illuminate\Http\Request;

class UserController extends ApiAppController
{
    public function index()
    {
        $resource = fractal(
            $this->userBuilder->with('info.speciality')->first(),
            new UserTransformer
        )->toArray();

        return response()->json([
            'user' => $resource['data']
        ]);
    }

    public function update(Request $request)
    {

    }
}