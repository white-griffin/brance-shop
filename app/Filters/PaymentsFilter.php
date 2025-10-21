<?php

namespace App\Filters;

class PaymentsFilter extends Contracts\QueryFilter
{
    public function payment_id($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('id', 'like', '%' . $value . '%');
        }
        return $this->builder;
    }

    public function order_id($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('order_id', 'like', '%' . $value . '%');
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

    public function status($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('status',  $value );
        }
        return $this->builder;
    }

    public function amount_from($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('amount','>=',$value );
        }
        return $this->builder;
    }

    public function amount_to($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('amount','<=',$value );
        }
        return $this->builder;
    }

    public function payment_token($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('payment_token', 'like', '%' . $value . '%');
        }
        return $this->builder;
    }

    public function transaction_id($value = null)
    {
        if (!is_null($value)) {
            return $this->builder->where('transaction_id', 'like', '%' . $value . '%');
        }
        return $this->builder;
    }

    public function orderableType($value = null)
    {

        if ($value == 'plan'){
            return $this->builder->whereHas('order',function ($q){
                $q->where('orderable_type',  'App\Models\Plan' )
                    ->where('orderable_id',request('plan'));
            });

        }elseif ($value == 'dictionary'){
            return $this->builder->whereHas('order',function ($q){
                $q->where('orderable_type',  'App\Models\Dictionary' )
                    ->where('orderable_id',request('dictionary'));
            });

        }
        return $this->builder;
    }

    public function discount_code($value = null)
    {
        if (is_null($value)) {
            return $this->builder->whereNull('discount_code_id');
        }
        return $this->builder->where('discount_code_id',  $value );

    }


}
