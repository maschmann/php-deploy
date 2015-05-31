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

/**
 * Class AnsibleServiceInterface
 *
 * @package Core\Ansible
 * @author Marc Aschmann <maschmann@gmail.com>
 */
interface AnsibleServiceInterface
{

    /**
     * @param string $playbook
     * @return \Asm\Ansible\Command\AnsiblePlaybookInterface
     */
    public function playbook($playbook);

    /**
     * @param string $playbook
     * @return \Asm\Ansible\Command\AnsibleGalaxyInterface
     */
    public function galaxy($playbook);
}
