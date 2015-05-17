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
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Deployment
 *
 * @package CoreBundle\Entity
 * @author Marc Aschmann <maschmann@gmail.com>
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Deployment
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    protected $state;

    /**
     * @ORM\Column(type="text")
     */
    protected $log;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @var ArrayCollection
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="deployments")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    protected $project;

    /**
     * @var ArrayCollection
     * @ORM\ManyToOne(targetEntity="AdminUser", inversedBy="deployments")
     * @ORM\JoinColumn(name="deployment_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * default constructor
     */
    public function __construct()
    {
        $this->created = new \DateTime();
        $this->project = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * @param mixed $log
     */
    public function setLog($log)
    {
        $this->log = $log;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param mixed $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
}
