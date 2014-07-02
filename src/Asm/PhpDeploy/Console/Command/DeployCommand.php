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
            ->setDescription('deploy onto a ftp server')
            ->addArgument(
                'project',
                InputArgument::OPTIONAL,
                'Which project do you want to deploy?'
            )
            ->addOption(
                'tag',
                't',
                InputOption::VALUE_OPTIONAL,
                'Set a tag to deploy. If none given, one will be created for you (YmdHis)',
                date('YmdHis')
            )
            ->addOption(
                'repository',
                'r',
                InputOption::VALUE_OPTIONAL,
                'Name of git repository to use'
            )
            ->addOption(
                'user',
                'u',
                InputOption::VALUE_OPTIONAL,
                'username for FTP'
            )
            ->addOption(
                'password',
                'p',
                InputOption::VALUE_OPTIONAL,
                'password for FTP'
            )
            ->addOption(
                'server',
                's',
                InputOption::VALUE_OPTIONAL,
                'FTP server name'
            )
            ->addOption(
                'port',
                'P',
                InputOption::VALUE_OPTIONAL,
                'FTP port. Defaults to 21',
                21
            );
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
