<?php
namespace Core\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

/**
 * Class BaseCommand
 *
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