<?php

namespace App\Filters;

class AdminLogFilter extends Contracts\QueryFilter
{
    public function admin($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('admin_id',  $value );
        }
        return $this->builder;
    }

    public function description($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('description', 'like', '%' . $value . '%');
        }
        return $this->builder;
    }

    public function date_from($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('created_at','>=',$value );
        }
        return $this->builder;
    }

    public function date_to($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('created_at','<=',$value );
        }
        return $this->builder;
    }
}
