<?php

namespace Tests;

use Illuminate\Database\Eloquent\Model;

class StubName extends Model
{
    use Commentable;
    protected $fillable = ['title',];

    /**
     * Get the connection of the entity.
     *
     * @return string|null
     */
    public function getQueueableConnection()
    {
        return '';
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed $value
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value)
    {
        // TODO: Implement resolveRouteBinding() method.
    }
}
