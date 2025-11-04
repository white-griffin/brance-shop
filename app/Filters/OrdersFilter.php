<?php

namespace App\Filters;

use App\Helpers\Format\Date;
use Illuminate\Http\Request;

class OrdersFilter extends Contracts\QueryFilter
{

    public function id($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('id',  $value );
        }
        return $this->builder;
    }
    public function user($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('user_id',  $value );
        }
        return $this->builder;
    }

    public function date_from($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('created_at','>=',Date::toCarbonDateFormat($value) );
        }
        return $this->builder;
    }

    public function date_to($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('created_at','<=',Date::toCarbonDateFormat($value) );
        }
        return $this->builder;
    }

    public function status($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('status',  $value );
        }
        return $this->builder;
    }



}
