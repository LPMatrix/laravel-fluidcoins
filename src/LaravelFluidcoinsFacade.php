<?php

namespace LPMatrix\LaravelFluidcoins;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LPMatrix\LaravelFluidcoins\Skeleton\SkeletonClass
 */
class LaravelFluidcoinsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-fluidcoins';
    }
}
