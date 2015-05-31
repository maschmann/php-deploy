<?php
/*
 * This file is part of the php-deploy package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Core\Ansible;

use Asm\Ansible\Ansible as AnsibleBase;

/**
 * Class Ansible
 *
 * @package Core\Ansible
 * @author Marc Aschmann <maschmann@gmail.com>
 */
final class Ansible implements AnsibleServiceInterface
{
    /**
     * @var string
     */
    private $playbookCommand;

    /**
     * @var string
     */
    private $galaxyCommand;

    /**
     * @param string $playbookCommand
     * @param string $galaxyCommand
     */
    public function __construct($playbookCommand, $galaxyCommand)
    {
        $this->playbookCommand = $playbookCommand;
        $this->galaxyCommand = $galaxyCommand;
    }

    /**
     * @param string $playbook
     * @return \Asm\Ansible\Command\AnsiblePlaybookInterface
     */
    public function playbook($playbook)
    {
        $ansible = new AnsibleBase(
            $playbook,
            $this->playbookCommand,
            $this->galaxyCommand
        );

        return $ansible->playbook();
    }

    /**
     * @param string $playbook
     * @return \Asm\Ansible\Command\AnsibleGalaxyInterface
     */
    public function galaxy($playbook)
    {
        $ansible = new AnsibleBase(
            $playbook,
            $this->playbookCommand,
            $this->galaxyCommand
        );

        return $ansible->galaxy();
    }
}
