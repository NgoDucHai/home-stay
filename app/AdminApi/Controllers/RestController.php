<?php

namespace App\AdminApi\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RestController
 * @package App\AdminApi\Controllers
 */
abstract class RestController extends Controller
{
    /**
     * @return string
     */
    protected abstract function getModelClass();

    /**
     * @return Model
     */
    protected function getModelInstance()
    {
        $modelClass = $this->getModelClass();

        return new $modelClass();
    }

    /**
     * @return Model[]
     */
    public function get()
    {
        return $this->getModelInstance()->get()->toArray();
    }

    /**
     * @return Model
     */
    public function create()
    {
        $model = $this->getModelInstance()->newInstance(request()->all());
        $model->save();

        return $model;
    }

    /**
     * @param $modelId
     */
    public function detail($modelId)
    {
        return $this->getModelInstance()->where('id', '=', $modelId)->firstOrFail();
    }

    /**
     * @param $modelId
     * @return Model
     */
    public function update($modelId)
    {
        /** @var Model $model */
        $model = $this->getModelInstance()->where('id', '=', $modelId)->firstOrFail();
        $model->update(request()->all());

        return $model;
    }

    /**
     * @param $modelId
     * @return Model
     */
    public function delete($modelId)
    {
        $model = $this->getModelInstance()->firstOrFail($modelId);
        $model->delete();

        return $model;
    }
}