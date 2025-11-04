<?php

namespace App\Filters;
use App\Filters\Contracts\QueryFilter;

class NotificationsFilter extends QueryFilter
{

    public function title($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('title', 'like', '%' . $value . '%');
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

    public function sendDate_from($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('publish_time','>=',$value );
        }
        return $this->builder;
    }

    public function sendDate_to($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('publish_time','<=',$value );
        }
        return $this->builder;
    }

    public function expireDate_from($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('expire_date','>=',$value );
        }
        return $this->builder;
    }

    public function expireDate_to($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('expire_date','<=',$value );
        }
        return $this->builder;
    }
    public function createDate_from($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('created_at','>=',$value );
        }
        return $this->builder;
    }

    public function createDate_to($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('created_at','<=',$value );
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

    public function type($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('type',  $value );
        }
        return $this->builder;
    }

}
