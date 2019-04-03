<?php

namespace App\Entities;

use OZA\Database\Query\Entity;

class UserEntity extends Entity
{

    /**
     * @param string $value
     * @return mixed
     */
    public function getEmailAttribute(string $value)
    {
        return strtoupper($value);
    }

    public function setNameAttribute($value)
    {
        return strtoupper($value);
    }
}