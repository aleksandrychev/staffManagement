<?php

namespace App\Http\Controllers\Api;

use App\Models\Accounts;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AccountsController extends Controller
{
    public function index(Request $request)
    {
        $accounts = Accounts::query()->paginate(5);

        return $accounts;
    }

    public function store(Request $request)
    {
        $account = new Accounts();
        $account->fill($request->all());
        if ($account->validate($request->all())) {
            $account->save();
        } else {
            return $account->errors();
        }

        return $account;
    }

    public function update(Request $request, $id)
    {
        $account = Accounts::query()->where('id', '=', $id)->first();
        $account->fill($request->all());
        if ($account->validate((array)$account)) {
            $account->save();
        } else {
            return $account->errors();
        }
        return $account;
    }

    public function destroy(Request $request, $id, Response $response)
    {
        $account = Accounts::query()->where('id', '=', $id)->first();
        if ($account) {
            $account->delete();
            $response->setStatusCode(204);
            return $response;
        } else {
            throw new NotFoundHttpException('Object not found');
        }

    }
}
