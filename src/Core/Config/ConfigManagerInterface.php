<?php
/*
 * This file is part of the php-deploy package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core\Config;

/**
 * Interface ConfigManagerInterface
 *
 * @author Marc Aschmann <maschmann@gmail.com>
 * @package Core\Config
 */
interface ConfigManagerInterface
{
    /**
     * @param string $type
     * @param string $file filename
     * @param int $ttl
     * @return \Asm\Config\ConfigInterface
     */
    public function get($type, $file, $ttl = 900);
}
