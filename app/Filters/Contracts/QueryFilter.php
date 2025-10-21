<?php


namespace App\Filters\Contracts;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{

    protected $builder;
    private $request;

    public function __construct()
    {
        $this->request = Request::capture();
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;
        foreach ($this->filters() as $key => $value)
        {
            if(!method_exists($this, $key))
            {
                continue;
            }
            (!empty($value)) ? $this->{$key}($value) : $this->{$key}();
        }
    }

    protected function filters()
    {
        //dd($this->request->all());
        return $this->request->all();
        //return $this->request->all();
    }

}