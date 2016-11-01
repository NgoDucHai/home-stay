<?php

namespace App\HomeStay\Apartment;

use App\HomeStay\Apartment\ApartmentStorageEngine\Engine;
use Illuminate\Support\Collection;

/**
 * Class ApartmentRepository
 * @package App\HomeStay\Apartment
 */
class ApartmentRepository
{
    /**
     * @var Engine
     */
    protected $engine;

    /**
     * @var ApartmentFactory
     */
    protected $factory;

    /**
     * ApartmentRepository constructor.
     *
     * @param Engine $engine
     * @param ApartmentFactory $factory
     */
    public function __construct(Engine $engine, ApartmentFactory $factory)
    {
        $this->engine  = $engine;
        $this->factory = $factory;
    }

    /**
     * @param ApartmentSearchCondition $condition
     * @return Collection
     */
    public function find(ApartmentSearchCondition $condition)
    {
        $query = $this->engine->buildQuery();

        $condition->decorateQuery($query);
        return $this->factory->factoryList($query->get());
    }

    /**
     * @param Apartment $apartment
     * @return $response
     */
    public function save(Apartment $apartment)
    {
        $response = $this->engine->save($apartment);
        return $response;
    }

    /**
     * @param int $id
     * @return Apartment
     */
    public function get($id)
    {
        $rawData = $this->engine->buildQuery()->find($id);
        return $rawData ? $this->factory->factory($rawData) : null;
    }

    public function getList()
    {
        $rawData =  $this->engine->buildQuery()->get();
        return $rawData ? $this->factory->factoryList($rawData) : null;
    }

    public function destroy($id)
    {
        return $this->engine->destroy($id);
    }
}
