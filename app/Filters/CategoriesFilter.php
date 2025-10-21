<?php


namespace App\Filters;


use App\Filters\Contracts\QueryFilter;

class CategoriesFilter extends QueryFilter
{
    public function title($value = null)
    {
        if(!is_null($value)){
            return $this->builder->where('title', 'like', '%'.$value.'%');
        }
        return $this->builder;
    }

    public function dictionary($value = null)
    {
        if(!is_null($value)){
            return $this->builder->where('dictionary_id', $value);
        }
        return $this->builder;
    }

    public function access($value = null)
    {
        if(!is_null($value)){
            return $this->builder->where('private_access',$value);
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
