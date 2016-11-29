<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @package App
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'age', 'avatar', 'description'
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
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $email;
    /**
     * @var string
     */
    protected $password;

    protected $avatar;
    protected $phone;
    protected $description;
    protected $age;

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

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail()
    {
        return $this->getAttribute('email');
    }

    public function getName()
    {
        return $this->getAttribute('name');
    }

    public function getAuthPassword()
    {
        return $this->getAttribute('password');
    }
}
