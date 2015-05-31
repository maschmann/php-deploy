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
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, unique=true)
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=false)
     */
    protected $playbook;

    /**
     * @var string
     * @ORM\Column(name="extra_vars", type="text", nullable=true)
     */
    protected $extraVars;


    /**
     * @var string
     * @ORM\Column(type="text", nullable=false)
     */
    protected $inventory;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $password;

    /**
     * @var string
     * @ORM\Column(name="su_password", type="string", length=255, nullable=true)
     */
    protected $suPassword;

    /**
     * @var string
     * @ORM\Column(name="vault_password", type="string", length=255, nullable=true)
     */
    protected $vaultPassword;

    /**
     * @var string
     * @ORM\Column(name="check_playbook", type="boolean")
     */
    protected $check;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $connection;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    protected $forceHandlers;

    /**
     * @var string
     * @ORM\Column(name="limit_playbook", type="string", length=255, nullable=true)
     */
    protected $limit;

    /**
     * @var string
     * @ORM\Column(name="module_path", type="text", nullable=true)
     */
    protected $modulePath;

    /**
     * @var string
     * @ORM\Column(name="private_key_file", type="text", nullable=true)
     */
    protected $privateKeyFile;

    /**
     * @var string
     * @ORM\Column(name="skip_paths", type="text", nullable=true)
     */
    protected $skipPaths;

    /**
     * @var string
     * @ORM\Column(name="start_at_task", type="string", length=255, nullable=true)
     */
    protected $startAtTask;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $su;

    /**
     * @var string
     * @ORM\Column(name="su_user", type="string", length=255, nullable=true)
     */
    protected $suUser;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $sudo;

    /**
     * @var string
     * @ORM\Column(name="sudo_user",type="string", length=255, nullable=true)
     */
    protected $sudoUser;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $tags;

    /**
     * @var integer
     * @ORM\Column(type="integer", length=4, nullable=true)
     */
    protected $timeout;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $username;

    /**
     * @var string
     * @ORM\Column(name="vault_password_file", type="text", nullable=true)
     */
    protected $vaultPasswordFile;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    protected $verbose;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @var \DateTime
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
        $this->check = false;
        $this->forceHandlers = false;
        $this->verbose = false;
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
    public function getPlaybook()
    {
        return $this->playbook;
    }

    /**
     * @param mixed $playbook
     * @return $this
     */
    public function setPlaybook($playbook)
    {
        $this->playbook = $playbook;

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

    /**
     * @return mixed
     */
    public function getInventory()
    {
        return $this->inventory;
    }

    /**
     * @param mixed $inventory
     * @return $this
     */
    public function setInventory($inventory)
    {
        $this->inventory = $inventory;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSuPassword()
    {
        return $this->suPassword;
    }

    /**
     * @param mixed $suPassword
     * @return $this
     */
    public function setSuPassword($suPassword)
    {
        $this->suPassword = $suPassword;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVaultPassword()
    {
        return $this->vaultPassword;
    }

    /**
     * @param mixed $vaultPassword
     * @return $this
     */
    public function setVaultPassword($vaultPassword)
    {
        $this->vaultPassword = $vaultPassword;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCheck()
    {
        return $this->check;
    }

    /**
     * @param mixed $check
     * @return $this
     */
    public function setCheck($check)
    {
        $this->check = $check;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param mixed $connection
     * @return $this
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getForceHandlers()
    {
        return $this->forceHandlers;
    }

    /**
     * @param boolean $forceHandlers
     * @return $this
     */
    public function setForceHandlers($forceHandlers)
    {
        $this->forceHandlers = $forceHandlers;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param mixed $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getModulePath()
    {
        return $this->modulePath;
    }

    /**
     * @param mixed $modulePath
     * @return $this
     */
    public function setModulePath($modulePath)
    {
        $this->modulePath = $modulePath;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrivateKeyFile()
    {
        return $this->privateKeyFile;
    }

    /**
     * @param mixed $privateKeyFile
     * @return $this
     */
    public function setPrivateKeyFile($privateKeyFile)
    {
        $this->privateKeyFile = $privateKeyFile;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSkipPaths()
    {
        return $this->skipPaths;
    }

    /**
     * @param mixed $skipPaths
     * @return $this
     */
    public function setSkipPaths($skipPaths)
    {
        $this->skipPaths = $skipPaths;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStartAtTask()
    {
        return $this->startAtTask;
    }

    /**
     * @param mixed $startAtTask
     * @return $this
     */
    public function setStartAtTask($startAtTask)
    {
        $this->startAtTask = $startAtTask;

        return $this;
    }

    /**
     * @return string
     */
    public function getSu()
    {
        return $this->su;
    }

    /**
     * @param string $su
     * @return $this
     */
    public function setSu($su)
    {
        $this->su = $su;

        return $this;
    }

    /**
     * @return string
     */
    public function getSuUser()
    {
        return $this->suUser;
    }

    /**
     * @param string $suUser
     * @return $this
     */
    public function setSuUser($suUser)
    {
        $this->suUser = $suUser;

        return $this;
    }

    /**
     * @return string
     */
    public function getSudo()
    {
        return $this->sudo;
    }

    /**
     * @param string $sudo
     * @return $this
     */
    public function setSudo($sudo)
    {
        $this->sudo = $sudo;

        return $this;
    }

    /**
     * @return string
     */
    public function getSudoUser()
    {
        return $this->sudoUser;
    }

    /**
     * @param string $sudoUser
     * @return $this
     */
    public function setSudoUser($sudoUser)
    {
        $this->sudoUser = $sudoUser;

        return $this;
    }

    /**
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param string $tags
     * @return $this
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @return integer
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @param integer $timeout
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getVaultPasswordFile()
    {
        return $this->vaultPasswordFile;
    }

    /**
     * @param string $vaultPasswordFile
     * @return $this
     */
    public function setVaultPasswordFile($vaultPasswordFile)
    {
        $this->vaultPasswordFile = $vaultPasswordFile;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getVerbose()
    {
        return $this->verbose;
    }

    /**
     * @param boolean $verbose
     * @return $this
     */
    public function setVerbose($verbose)
    {
        $this->verbose = $verbose;

        return $this;
    }
}
