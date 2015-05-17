<?php
/*
 * This file is part of the php-deploy package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Core\Common;

/**
 * Interface ProviderInterface
 *
 * @package Core\Common
 * @author Marc Aschmann <maschmann@gmail.com>
 */
interface ProviderInterface
{
    /**
     * Default interface for providers.
     *
     * @param string $alias
     * @return mixed
     */
    public function get($alias);
}
