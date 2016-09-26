<?php

namespace App\HomeStay\Application;

interface ApplicationState
{
    const PENDING   = 'PENDING';
    const ACCEPTED  = 'ACCEPTED';
    const CANCELLED = 'CANCELLED';
    const DEAL      = 'DEAL';
}
