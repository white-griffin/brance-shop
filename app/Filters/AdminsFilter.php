<?php


namespace App\Filters;
use App\Filters\Contracts\QueryFilter;

class AdminsFilter extends QueryFilter
{
    public function  first_name ($value = null)
    {
        if(!is_null($value)){
            return $this->builder->where('first_name', 'like', '%'.$value.'%');
        }
        return $this->builder;
    }
    public function last_name($value = null)
    {
        if(!is_null($value)){
            return $this->builder->where('last_name', 'like', '%'.$value.'%');
        }
        return $this->builder;
    }
    public function username($value = null)
    {
        if(!is_null($value)){
            return $this->builder->where('username', 'like', '%'.$value.'%');
        }
        return $this->builder;
    }

    public function mobile($value = null)
    {
        if(!is_null($value)){
            return $this->builder->where('mobile', 'like', '%'.$value.'%');
        }
        return $this->builder;
    }

}
