<?php


namespace App\Filters\Contracts;


trait Filterable
{
    public function scopeFilter($query, QueryFilter $filter)
    {
        return $filter->apply($query);
    }
}
