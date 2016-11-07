<?php

namespace ThinhHung\FFMpeg;

use Illuminate\Support\ServiceProvider;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use Config;

class FFMpegServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the configuration.
     *
     * @return void
     */
    public function boot()
    {
        $ffmpegSource = dirname(__DIR__).'/config/ffmpeg.php';
        $this->publishes([
            $ffmpegSource => config_path('ffmpeg.php'),
        ]);

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([
                $ffmpegSource => config_path('ffmpeg.php'),
            ]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('ffmpeg');
        }

        $this->mergeConfigFrom($ffmpegSource, 'ffmpeg');
    }

    /**
     * Register the service container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ffmpeg', function ($app) {
            return FFMpeg::create($app->make('config')->get('ffmpeg'));
        });
        $this->app->singleton('ffprobe', function ($app) {
            return FFProbe::create($app->make('config')->get('ffmpeg'));
        });
        $this->app->alias('ffmpeg', 'FFMpeg\FFMpeg');
        $this->app->alias('ffprobe', 'FFMpeg\FFProbe');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['ffmpeg', 'ffprobe', 'FFMpeg\FFMpeg', 'FFMpeg\FFProbe'];
    }
}
