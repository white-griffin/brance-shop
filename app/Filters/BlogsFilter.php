<?php

namespace App\Filters;

class BlogsFilter extends Contracts\QueryFilter
{
    public function  title ($value = null)
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
