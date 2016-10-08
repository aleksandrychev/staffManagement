<?php

namespace App\Http\Controllers\Api;

use App\Models\Accounts;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AccountsController extends Controller
{
   public function index(Request $request){
       return Accounts::all();
   }

    public function store(Request $request){
        return $request;
    }

    public function update(Request $request){
        return $request;
    }

    public function destroy(Request $request){
        return $request;
    }
}
