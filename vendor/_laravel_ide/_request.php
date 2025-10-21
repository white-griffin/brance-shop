<?php

namespace Illuminate\Http;

interface Request
{
    /**
     * @return \App\Models\Admin|null
     */
    public function user($guard = null);
}