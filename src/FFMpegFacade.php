<?php

namespace ThinhHung\FFMpeg;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Illuminate\Foundation\Application
 */
class FFMpegFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ffmpeg';
    }
}