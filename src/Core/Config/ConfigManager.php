<?php
/*
 * This file is part of the <package> package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core\Config;

use \Asm\Config\Config;
use Doctrine\Common\Cache\CacheProvider;

/**
 * Class ConfigManager
 *
 * @package Core\Config
 * @author maschmann@gmail.com
 */
final class ConfigManager
{
    /**
     * @var string
     */
    private $environment;

    /**
     * @var \Doctrine\Common\Cache\CacheProvider
     */
    private $cacheProvider;

    /**
     * @var string
     */
    private $rootDir;

    /**
     * @param CacheProvider $cacheProvider
     * @param string $environment
     * @param string $rootDir
     */
    public function __construct(
        CacheProvider $cacheProvider,
        $environment,
        $rootDir
    ) {
        $this->cacheProvider = $cacheProvider;
        $this->environment   = $environment;
        $this->rootDir       = $rootDir;
    }

    /**
     * @inheritdoc
     */
    public function get($type, $file, $ttl = 900)
    {
        // get file from cache
        $config = $this->cacheProvider->fetch($file);

        if (false === $config) {
            $config = Config::factory(
                array(
                    'file' => $this->rootDir . '/config/' . $file,
                    'env'  => $this->environment,
                ),
                $type
            );
            $this->cacheProvider->save($file, $config, $ttl);
        }

        return $config;
    }
}
