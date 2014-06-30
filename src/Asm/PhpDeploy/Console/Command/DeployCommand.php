<?php
/*
 * This file is part of the php-deploy package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Asm\PhpDeploy\Console\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DeployCommand
 *
 * @package Asm\Console\Command
 * @author Marc Aschmann <maschmann@gmail.com>
 */
class DeployCommand extends BaseCommand
{
    /**
     * default configuration method
     */
    protected function configure()
    {
        $this
            ->setName('deploy:ftp')
            ->setDescription('deploy onto a ftp server');

        // server, port (opt), deployment tag(?),
        /*
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'Who do you want to greet?'
            )
            ->addOption(
                'yell',
                null,
                InputOption::VALUE_NONE,
                'If set, the task will yell in uppercase letters'
            );
        */
    }

    /**
     * execute command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {   $text = 'testing done';

        $output->writeln($text);
    }
}
