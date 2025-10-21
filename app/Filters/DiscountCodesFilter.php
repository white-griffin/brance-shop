<?php

namespace App\Filters;
use App\Filters\Contracts\QueryFilter;

class DiscountCodesFilter extends QueryFilter
{
    public function title($value = null)
    {
        if(!is_null($value)){
            return $this->builder->where('title', 'like', '%'.$value.'%');
        }
        return $this->builder;
    }

    public function code($value = null)
    {
        if(!is_null($value)){
            return $this->builder->where('code', 'like', '%'.$value.'%');
        }
        return $this->builder;
    }

    public function user($value = null)
    {
        if(!is_null($value)){
            return $this->builder->where('user_id', $value);
        }
        return $this->builder;
    }

    public function plan($value = null)
    {
        if(!is_null($value)){
            return $this->builder->where('plan_id', $value);
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
