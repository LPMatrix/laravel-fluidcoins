<?php

namespace LPMatrix\FluidCoins;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LPMatrix\LaravelFluidcoins\Skeleton\SkeletonClass
 */
class FluidcoinsFacade extends Facade
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
