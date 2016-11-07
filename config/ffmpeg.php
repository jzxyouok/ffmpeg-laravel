<?php

return [

    /*
    |--------------------------------------------------------------------------
    | FFMpeg System Path
    |--------------------------------------------------------------------------
    |
    | We need to know the fully qualified system path to where ffmpeg
    | lives on this server. If you paste this path into your shell or
    | command prompt you should get output from ffmpeg.
    |
    | Examples:
    | Windows: 'C:/ffmpeg/bin/ffmpeg.exe'
    | Mac OSX: '/Applications/MAMP/ffmpeg/ffmpeg'
    | Linux:   '/usr/bin/ffmpeg'
    |
    */

   'ffmpeg.binaries'        => env('FFMPEG_PATH', '/usr/bin/ffmpeg'),

    /*
    |--------------------------------------------------------------------------
    | FFMpeg Number Of Threads
    |--------------------------------------------------------------------------
    |
    */

   'ffmpeg.threads'        => 4,

    /*
    |--------------------------------------------------------------------------
    | FFMpeg Timeout
    |--------------------------------------------------------------------------
    |
    */

   'ffmpeg.timeout'        => 300,

    /*
    |--------------------------------------------------------------------------
    | FFProbe System Path
    |--------------------------------------------------------------------------
    |
    | We need to know the fully qualified system path to where ffprobe
    | lives on this server. If you paste this path into your shell or
    | command prompt you should get output from ffprobe.
    |
    | Examples:
    | Windows: 'C:/ffmpeg/bin/ffprobe.exe'
    | Mac OSX: '/Applications/MAMP/ffmpeg/ffprobe'
    | Linux:   '/usr/bin/ffprobe'
    |
    */

   'ffprobe.binaries'        => env('FFPROBE_PATH', '/usr/bin/ffprobe'),

    /*
    |--------------------------------------------------------------------------
    | FFProbe Timeout
    |--------------------------------------------------------------------------
    |
    */

   'ffprobe.timeout'        => 30,

];