<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Viewable
{
    public function views(): MorphMany;

}
