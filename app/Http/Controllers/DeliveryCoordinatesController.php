<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryCoordinatesController extends Controller
{
    public function update()
    {
        abort_unless(
            Auth::user()->tokenCan('coordinates:update'),
            403,
            "You don't have permissions to perform this action."
        );

//        $data = $request->validated();
        $data = request()->validate(
            [
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
            ]
        );

        $user = Auth::user();
        $user->config = array_merge($user->config,[
            'latitude' => request('latitude'),
            'longitude' => request('longitude'),
        ]);
        $user->save();

        return new UserResource($user);
    }
}
