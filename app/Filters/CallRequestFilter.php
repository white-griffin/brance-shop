<?php

namespace App\Filters;

class CallRequestFilter extends Contracts\QueryFilter
{
    public function status($value = null)
    {
        if(!is_null($value)){
            return $this->builder->where('status',$value);
        }
        return $this->builder;
    }
}
