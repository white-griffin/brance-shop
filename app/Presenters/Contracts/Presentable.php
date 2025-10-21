<?php


namespace App\Presenters\Contracts;


use Carbon\Carbon;

trait Presentable
{

    protected $presenterInstance;

    public function webPresent()
    {
        if(!$this->webPresenter || !class_exists($this->webPresenter)){
            throw new \Exception('presenter not fount!');
        }

        if(!$this->presenterInstance){
            $this->presenterInstance = new $this->webPresenter($this);
        }

        return $this->presenterInstance;

    }
    public function apiPresent()
    {
        if(!$this->apiPresenter || !class_exists($this->apiPresenter)){
            throw new \Exception('presenter not fount!');
        }

        if(!$this->presenterInstance){
            $this->presenterInstance = new $this->apiPresenter($this);
        }

        return $this->presenterInstance;

    }
}
