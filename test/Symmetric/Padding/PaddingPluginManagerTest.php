<?php

namespace LaminasTest\Crypt\Symmetric\Padding;

use Interop\Container\ContainerInterface;
use Laminas\Crypt\Symmetric\Exception;
use Laminas\Crypt\Symmetric\Padding\PaddingInterface;
use Laminas\Crypt\Symmetric\PaddingPluginManager;
use PHPUnit\Framework\TestCase;

class PaddingPluginManagerTest extends TestCase
{
    public function getPaddings()
    {
        return [
            ['pkcs7'],
            ['nopadding'],
            ['null'],
        ];
    }

    public function testConstruct()
    {
        $plugin = new PaddingPluginManager();
        $this->assertInstanceOf(ContainerInterface::class, $plugin);
    }

    /**
     * @dataProvider getPaddings
     */
    public function testHas($padding)
    {
        $plugin = new PaddingPluginManager();
        $this->assertTrue($plugin->has($padding));
    }

    /**
     * @dataProvider getPaddings
     */
    public function testGet($padding)
    {
        $plugin = new PaddingPluginManager();
        $this->assertInstanceOf(PaddingInterface::class, $plugin->get($padding));
    }

    public function testGetError()
    {
        $plugin = new PaddingPluginManager();

        $this->expectException(Exception\NotFoundException::class);
        $plugin->get('foo');
    }
}
