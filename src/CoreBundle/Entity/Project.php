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
 * Class Project
 *
 * @package CoreBundle\Entity
 * @author Marc Aschmann <maschmann@gmail.com>
 * @ORM\Entity
 * @ORM\Table(name="project")
 */
class Project
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    protected $name;

    /**
     * @ORM\Column(type="text")
     */
    protected $repository;

    /**
     * @ORM\Column(type="text")
     */
    protected $ansiblePath;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $extraVars;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $changed;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Deployment", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="project_deployments",
     *      joinColumns={@ORM\JoinColumn(name="project_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="deployment_id", referencedColumnName="id", unique=true)}
     *
     * )
     **/
    protected $deployments;

    /**
     * default constructor
     */
    public function __construct()
    {
        $this->created = new \DateTime();
        $this->changed = new \DateTime();
        $this->deployments = new ArrayCollection();
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param mixed $repository
     * @return $this
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return mixed
     */
    public function getChanged()
    {
        return $this->changed;
    }

    /**
     * @param mixed $changed
     * @return $this
     */
    public function setChanged(\DateTime $changed = null)
    {
        if (null == $changed) {
            $changed = new \Datetime();
        }
        $this->changed = $changed;

        return $this;
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
     * @return $this
     */
    public function addDeployment(Deployment $deployment)
    {
        $this->deployments->add($deployment);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAnsiblePath()
    {
        return $this->ansiblePath;
    }

    /**
     * @param mixed $ansiblePath
     * @return $this
     */
    public function setAnsiblePath($ansiblePath)
    {
        $this->ansiblePath = $ansiblePath;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExtraVars()
    {
        return $this->extraVars;
    }

    /**
     * @param mixed $extraVars
     * @return $this
     */
    public function setExtraVars($extraVars)
    {
        $this->extraVars = $extraVars;

        return $this;
    }
}
