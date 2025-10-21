<?php

namespace App\Filters;
use App\Filters\Contracts\QueryFilter;

class ProductFilter extends QueryFilter
{

    public function title($value = null)
    {
        if(!is_null($value)){
            return $this->builder->where('title', 'like', '%'.$value.'%');
        }
        return $this->builder;
    }

    public function status($value = null)
    {
        if(!is_null($value)){
            return $this->builder->where('status',$value);
        }
        return $this->builder;
    }
}
