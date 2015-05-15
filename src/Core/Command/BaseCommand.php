<?php
/*
 * This file is part of the <package> package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Core\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

/**
 * Class BaseCommand
 *
 * @author Marc Aschmann <maschmann@gmail.com>
 * @package Core\Command
 */
class BaseCommand extends ContainerAwareCommand
{
    /**
     * @param string $service
     * @return object
     */
    public function get($service)
    {
        return $this->getContainer()->get($service);
    }
}
