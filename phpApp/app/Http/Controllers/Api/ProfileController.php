<?php

namespace App\Http\Controllers\Api;

use App\Models\DeviceTokens\DeviceTokens;
use App\Http\Controllers\BaseApiController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProfileController extends BaseApiController
{

    public function storeDeviceToken(Request $request)
    {
        $deviceToken = new DeviceTokens();
        $deviceToken->fill($request->all());
        $deviceToken->user_id = $request->user()->id;
        
        if ($deviceToken->validate($request->all())) {
            $deviceToken->save();
        } else {
            return $deviceToken->errors();
        }
        return $deviceToken;
    }


    public function destroyDeviceToken(Request $request, $token, Response $response)
    {
        $deviceToken = DeviceTokens::query()->where('token', 'like', $token)->first();
        if ($deviceToken) {
            $deviceToken->delete();
            $response->setStatusCode(204);
            return $response;
        } else {
            throw new NotFoundHttpException('Object not found');
        }

    }
}
