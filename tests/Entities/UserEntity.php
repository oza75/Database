<?php


namespace OZA\Database\Tests\Entities;


use OZA\Database\Query\Entity;
use OZA\Database\Query\Relations\ManyToOne;

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

    /**
     * @return ManyToOne
     */
    public function posts()
    {
        return $this->manyToOne(PostEntity::class, 'user_id', 'id');
    }
}