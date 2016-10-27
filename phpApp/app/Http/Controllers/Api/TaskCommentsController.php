<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use App\Models\TaskComments\TaskComments;
use App\Models\Tasks\Tasks;
use App\Models\Tasks\TaskSearch;
use Illuminate\Http\Request;
use App\Http\Requests;

class TaskCommentsController extends BaseApiController
{
    public function __construct()
    {
        $this->middleware('set.request.user.id', ['except' => ['index','show']]);
    }

    public function show($taskId, $commentId)
    {
        dd($taskId, $commentId);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder
     */
    public function index(Request $request, $taskId)
    {
        $searchModel = new TaskSearch($request);
        $tasks = $searchModel->search();
        $tasks = $tasks->paginate($this->perPage);

        return $tasks;
    }

    /**
     * @param Request $request
     * @return Tasks
     */
    public function store(Request $request, $taskId)
    {
        $model = new TaskComments();
        $model->fill($request->all());
        $model->user_id = $request->user()->id;

        if ($model->validate($request->all())) {
            $model->save();
        } else {
            return $model->errors();
        }

        return $model;
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function update(Request $request, $id)
    {
        $model = Tasks::query()->where('id', '=', $id)->first();
        $model->fill($request->all());
        if ($model->validate($request->all())) {
            $model->save();
        } else {
            return $model->errors();
        }
        return $model;
    }

    /**
     * @param $id
     * @param Response $response
     * @return Response
     */
    public function destroy($id, Response $response)
    {
        $account = Tasks::query()->where('id', '=', $id)->first();
        if ($account) {
            $account->delete();
            $response->setStatusCode(204);
            return $response;
        } else {
            throw new NotFoundHttpException('Object not found');
        }

    }
}
