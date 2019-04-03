<?php


namespace OZA\Database\Query\Traits;


use OZA\Database\Query\Relations\ManyToOne;

trait HasRelations
{

    /**
     * @param string $related
     * @param string|null $localKey
     * @param string|null $foreignKey
     * @return ManyToOne
     */
    public function manyToOne(string $related, string $foreignKey, ?string $localKey = null)
    {
        return new ManyToOne($related, $foreignKey, $this->getAttribute($localKey ?? $this->primaryKey));
    }

}