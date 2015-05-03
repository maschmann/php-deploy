<?php
namespace CoreBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Core\Command\BaseCommand;

/**
 * Class DefaultCommand
 * @package CoreBundle\Command
 */
class DefaultCommand extends BaseCommand
{
    /**
     * default configure method
     */
    protected function configure()
    {
        $this->setName('core:default:command')
            ->setDescription('default command implementation');
    }

    /**
     * default execution command
     *
     * @param  \Symfony\Component\Console\Input\InputInterface $input
     * @param  \Symfony\Component\Console\Output\OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $verbose = $input->getOption('verbose');
    }
}