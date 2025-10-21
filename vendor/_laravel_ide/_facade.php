<?php

namespace Illuminate\Support\Facades;

interface Auth
{
    /**
     * @return \App\Models\Admin|false
     */
    public static function loginUsingId(mixed $id, bool $remember = false);

    /**
     * @return \App\Models\Admin|false
     */
    public static function onceUsingId(mixed $id);

    /**
     * @return \App\Models\Admin|null
     */
    public static function getUser();

    /**
     * @return \App\Models\Admin
     */
    public static function authenticate();

    /**
     * @return \App\Models\Admin|null
     */
    public static function user();

    /**
     * @return \App\Models\Admin|null
     */
    public static function logoutOtherDevices(string $password);

    /**
     * @return \App\Models\Admin
     */
    public static function getLastAttempted();
}