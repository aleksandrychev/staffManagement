<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use App\Models\Accounts\AccountSearch;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AccountsController extends BaseApiController
{
    public function index(Request $request)
    {
        $searchModel = new AccountSearch($request);
        $accounts = $searchModel->search();
        $accounts = $accounts->paginate($this->perPage);

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
