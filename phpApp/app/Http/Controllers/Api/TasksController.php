<?php

namespace App\Http\Controllers\Api;

use App\Events\AddTaskEvent;
use App\Http\Controllers\BaseApiController;
use App\Models\Tasks\Tasks;
use App\Models\Tasks\TaskSearch;
use Illuminate\Http\Request;
use App\Http\Requests;

/**
 * Class TasksController
 * @package App\Http\Controllers\Api
 * @todo Validation for update
 */
class TasksController extends BaseApiController
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder
     */
    public function index(Request $request)
    {
        $searchModel = new TaskSearch($request);
        $tasks = $searchModel->search();
        $tasks = $tasks->paginate($this->perPage);

        return $tasks;
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function show(Request $request, $id)
    {
        $task = Tasks::find($id);
        return $task;
    }

    /**
     * @param Request $request
     * @return Tasks
     */
    public function store(Request $request)
    {
        $model = new Tasks();
        $model->fill($request->all());
        if ($model->validate($request->all())) {
            if($model->save()){
                \Event::fire(new AddTaskEvent($model));
            }
        } else {
            return response()->json($model->errors(), 422);
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
        $t = new Tasks();
        $rules = array_intersect_key($t->getRules(),$request->all());
        if ($model->validate($request->all(), $rules)) {
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
