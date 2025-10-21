<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Orderable
{
    public function orders(): MorphMany;

}
