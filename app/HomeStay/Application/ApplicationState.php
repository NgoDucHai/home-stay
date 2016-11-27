<?php

namespace App\HomeStay\Application;

/**
 * Interface ApplicationState
 * @package App\HomeStay\Application
 */
interface ApplicationState
{
    /**
     * Represents as pending state
     */
    const PENDING   = 'PENDING';
    /**
     * Represents as accepted state
     */
    const ACCEPTED  = 'ACCEPTED';
    /**
     * Represents as cancelled state
     */
    const CANCELLED = 'CANCELLED';
    /**
     * Represents as deal state
     */
    const DEAL      = 'DEAL';
}
