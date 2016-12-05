<?php

namespace App\HomeStay\Application;

use App\User;
use App\HomeStay\Apartment\Apartment;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Application
 *
 * @package App\HomeStay\Application
 * @mixin \Eloquent
 */
class Application extends Model
{
    /**
     * @param $applicantId
     * @return static
     */
    public function setApplicantId($applicantId)
    {
        $this->setAttribute('user_id', $applicantId);
        return $this;
    }

    /**
     * @param $apartmentId
     * @return $this
     */
    public function setApartmentId($apartmentId)
    {
        $this->setAttribute('apartment_id', $apartmentId);

        return $this;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->setAttribute('id', $id);

        return $this;
    }

    /**
     * @return int
     */
    public function getApartmentId()
    {
        return intval($this->getAttribute('apartment_id'));
    }

    /**
     * @param string $state
     * @return self
     */
    public function setState($state)
    {
        $this->setAttribute('state', $state);

        return $this;
    }

    /**
     * @param $message
     * @return $this
     */

    public function setMessage($message)
    {
        $this->setAttribute('message', $message);

        return $this;
    }


    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->getAttribute('message');
    }

    /**
     * @return mixed
     */

    public function getId()
    {
        return $this->getAttribute('id');
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->getAttribute('user_id');
    }

}
