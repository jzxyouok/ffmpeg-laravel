<?php

namespace ThinhHung\FFMpeg\Test;

use ThinhHung\FFMpeg\FFMpegFacade as FFMpeg;
use ThinhHung\FFMpeg\FFProbeFacade as FFProbe;
use ThinhHung\FFMpeg\FFMpegServiceProvider;
use Illuminate\Container\Container;

abstract class FFMpegServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testFacadeCanBeResolvedToServiceInstance()
    {
        $app = $this->setupApplication();
        $this->setupServiceProvider($app);
        // Mount facades
        FFMpeg::setFacadeApplication($app);
        FFProbe::setFacadeApplication($app);
        // Get an instance of a ffmpeg via the facade.
        $ffmpeg = FFMpeg::create();
        $this->assertInstanceOf('FFMpeg\FFMpeg', $ffmpeg);
        // Get an instance of a ffprobe via the facade.
        $ffprobe = FFProbe::create();
        $this->assertInstanceOf('FFMpeg\FFProbe', $ffprobe);
    }

    public function testRegisterFFMpegServiceProviderWithPackageConfigAndEnv()
    {
        $app = $this->setupApplication();
        $this->setupServiceProvider($app);
        // Get an instance of a ffmpeg.
        /** @var \FFMpeg\FFMpeg $ffmpeg */
        $ffmpeg = $app['ffmpeg'];
        $this->assertInstanceOf('FFMpeg\FFMpeg', $ffmpeg);
        /** @var \FFMpeg\FFProbe $ffprobe */
        $ffprobe = $app['ffprobe'];
        $this->assertInstanceOf('FFMpeg\FFProbe', $ffprobe);
        // Verify that the ffmpeg received the configuration from the package config.
        /** @var \Alchemy\BinaryDriver\Configuration $ffmpegConfiguration */
        $ffmpegConfiguration = $ffmpeg->getFFMpegDriver()->getConfiguration();
        $this->assertEquals(true, $ffmpegConfiguration->has('ffmpeg.binaries'));
        $this->assertEquals(true, $ffmpegConfiguration->has('ffmpeg.timeout'));
        $this->assertEquals(true, $ffmpegConfiguration->has('ffmpeg.threads'));

        // Verify that the ffprobe received the configuration from the package config.
        /** @var \Alchemy\BinaryDriver\Configuration $ffprobeConfiguration */
        $ffprobeConfiguration = $ffprobe->getFFProbeDriver()->getConfiguration();
        $this->assertEquals(true, $ffprobeConfiguration->has('ffprobe.binaries'));
        $this->assertEquals(true, $ffprobeConfiguration->has('ffprobe.timeout'));
    }

    public function testServiceNameIsProvided()
    {
        $app = $this->setupApplication();
        $provider = $this->setupServiceProvider($app);
        $this->assertContains('ffmpeg', $provider->provides());
        $this->assertContains('ffprobe', $provider->provides());
    }

    /**
     * @return Container
     */
    abstract protected function setupApplication();

    /**
     * @param Container $app
     *
     * @return AwsServiceProvider
     */
    private function setupServiceProvider(Container $app)
    {
        // Create and register the provider.
        $provider = new FFMpegServiceProvider($app);
        $app->register($provider);
        $provider->boot();
        return $provider;
    }
}