<?php

namespace App\Traits;

trait Translatable
{
    /**
     * Display translated attribute
     *
     * @param $column
     * @return mixed
     */
    public function trans($column)
    {
        return isLocaleEn() ? $this->{$column} : $this->{$column. '_ar'};
    }
}