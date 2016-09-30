<?php

namespace App\HomeStay\ReviewingService;
use App\HomeStay\Numerable;

/**
 * Class Rating
 * @package App\HomeStay\ReviewingService
 */
class Rating implements Numerable
{
    /**
     * @var int
     */
    protected $value;

    /**
     * Rating constructor.
     * @param int $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function toNumber()
    {
        return $this->value;
    }
}
