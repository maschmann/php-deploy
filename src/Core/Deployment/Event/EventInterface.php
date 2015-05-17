<?php
/*
 * This file is part of the php-deploy package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Core\Deployment\Event;

use Core\Common\ReferenceInterface;

/**
 * Interface EventInterface
 *
 * @package Core\Page\Event
 * @author Marc Aschmann <maschmann@motorpresse.de>
 */
interface EventInterface extends ReferenceInterface
{
    /**
     * handle the event
     *
     * @param AbstractDeploymentEvent $event
     * @return mixed
     */
    public function handle(AbstractDeploymentEvent $event);
}
