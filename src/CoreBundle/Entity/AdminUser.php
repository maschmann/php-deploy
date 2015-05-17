<?php
/*
 * This file is part of the php-deploy package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="admin_user")
 */
class AdminUser extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Project", mappedBy="user")
     */
    protected $projects;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Deployment", mappedBy="user")
     */
    protected $deployments;

    /**
     * parent constructor call
     */
    public function __construct()
    {
        parent::__construct();

        $this->deployments = new ArrayCollection();
        $this->projects = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * @param Project $project
     */
    public function addProject(Project $project)
    {
        $this->projects->add($project);
    }

    /**
     * @return ArrayCollection
     */
    public function getDeployments()
    {
        return $this->deployments;
    }

    /**
     * @param Deployment $deployment
     */
    public function addDeployment(Deployment $deployment)
    {
        $this->deployments->add($deployment);
    }
}
