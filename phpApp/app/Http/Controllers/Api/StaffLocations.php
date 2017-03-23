<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\Request;

class StaffLocations extends BaseApiController
{


    public function index(Request $request)
    {
        return \App\Models\StaffLocations\StaffLocations::all();
//    var_dump($request);exit;
//        $locations =  \App\Models\StaffLocations\StaffLocations::query()->first();
//        return $locations;
    }


    public function store(Request $request)
    {
        $model = new \App\Models\StaffLocations\StaffLocations();
        $model->fill($request->all());
        $model->user_id = $request->user()->id;

        if ($model->validate($request->all())) {
            $model->save();
        } else {
            return $model->errors();
        }

        return $model;
    }
}
