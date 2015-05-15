<?php
namespace CoreBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Core\Command\BaseCommand;

/**
 * Class DeployCommand
 * @author Marc Aschmann <maschmann@gmail.com>
 * @package CoreBundle\Command
 */
class DeployCommand extends BaseCommand
{
    /**
     * default configure method
     */
    protected function configure()
    {
        $this->setName('core:deploy')
            ->setDescription('Base deployment command')
            ->addOption('host', null, InputOption::VALUE_REQUIRED, 'Host to deploy (ansible hosts)')
            ->addOption('client', 'c', InputOption::VALUE_REQUIRED, 'Client config to use')
            ->addOption('tag', 't', InputOption::VALUE_OPTIONAL, 'Hash, branch or tag to deploy', 'master');
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
        $host = $input->getOption('host');
        $client = $input->getOption('client');
        $tag = $input->getOption('tag');
    }
}
