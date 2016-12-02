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
     *
     */
    public function get()
    {
        return $this->getModelInstance()->get()->toArray();
    }

    /**
     * @param Model $model
     *
     * @return Model
     */
    public function create(Model $model)
    {
        $model->save();

        return $model;
    }

    /**
     * @param $modelId
     */
    public function detail($modelId)
    {
        return $this->getModelInstance()->firstOrFail('id', '=', $modelId);
    }

    /**
     * @param Model $model
     * @return Model
     */
    public function update(Model $model)
    {
        $model->save();

        return $model;
    }

    /**
     * @param $modelId
     */
    public function delete($modelId)
    {
        $this->getModelInstance()->delete('id', '=', $modelId);
    }
}