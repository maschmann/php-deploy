<?php
/*
 * This file is part of the <package> package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Core\Tests;

use Core\Config\ConfigManager;
use Core\Test\CoreTestCase;

/**
 * Class ConfigManagerTest
 *
 * @package Core\Tests\Config
 * @author Marc Aschmann <maschmann@gmail.com>
 */
class ConfigManagerTest extends CoreTestCase
{

    /**
     * @covers \Core\Config\ConfigManager::__construct
     */
    public function testGetInstance()
    {
        $cache = $this->getMockForAbstractClass('Doctrine\Common\Cache\CacheProvider');

        $configManager = new ConfigManager(
            $cache,
            'dev',
            'test'
        );

        $this->assertInstanceOf('\Core\Config\ConfigManager', $configManager);

        return $configManager;
    }

    /**
     * @covers  \Core\Config\ConfigManager::get
     */
    public function testGet()
    {
        $cache = $this->getCacheProviderMock();

        $configManager = new ConfigManager(
            $cache,
            'dev',
            $this->root->url()
        );

        $config = $configManager->get(
            'ConfigEnv',
            'test.yml'
        );

        $this->assertInstanceOf('\Asm\Config\ConfigInterface', $config);
    }
}
