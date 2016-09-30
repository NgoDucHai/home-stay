<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'password', 'remember_token',
    ];

    /**
     * @return int id
     */
    public function getId()
    {
        return $this->getAttribute('id');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isMe(User $user)
    {
        return $this->getId() == $user->getId();
    }
}
