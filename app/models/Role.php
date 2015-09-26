<?php

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    public static function relationArrayWithCache()
    {
        return Cache::remember('all_assigned_roles', $minutes = 60, function()
        {
            return DB::table('assigned_roles')->get();
        });
    }

    public static function rolesArrayWithCache()
    {
        return Cache::remember('all_roles', $minutes = 60, function()
        {
            return DB::table('roles')->get();
        });
    }
}
