<?php
/*
 * This file is part of the <package> package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Core\Test;

use Asm\Config\ConfigInterface;
use Asm\Data\Data;
use org\bovigo\vfs\vfsStream;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class CoreTestCase
 *
 * Base class for functional tests
 *
 * @package Core\Test
 * @author Marc Aschmann <maschmann@gmail.com>
 */
abstract class CoreTestCase extends WebTestCase
{
    /**
     * @var vfsStream
     */
    protected $root;

    /**
     * @var Application
     */
    protected $application;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        if (null === static::$kernel) {
            static::$kernel = static::createKernel();
        }
        static::$kernel->boot();
        $this->createServices();
        static::$kernel->boot();
        $this->application = new Application(static::$kernel);

        // create vfs mock
        $this->createConfig();
    }

    /**
     * {@inheritdoc}
     */
    protected function createServices()
    {
    }

    /**
     * @return ConfigMock
     */
    protected function getConfigMock()
    {
        return new ConfigMock();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getConnectionManagerMock()
    {
        return $this->getMock('\Core\Connection\ConnectionManagerInterface');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getContentProviderMock()
    {
        return $this->getMock('\Core\Content\ContentProviderInterface');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getContextManagerMock()
    {
        $context = $this->getMock('\Core\System\ContextInterface');
        $contextManager = $this->getMockBuilder('\Core\System\ContextManagerInterface')->getMock();
        $contextManager
            ->expects($this->once())
            ->method('get')
            ->willReturn($context);

        return $contextManager;
    }

    /**
     * generate doctrine registry mock object
     *
     * @return \Doctrine\Common\Persistence\ManagerRegistry
     */
    protected function getDoctrineMock()
    {
        return new ManagerRegistryMock();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getTemplateFinderMock()
    {
        return $this->getMock('\Core\Template\Finder');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getLoggerMock()
    {
        return $this->getMock('\Psr\Log\LoggerInterface');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getTemplatingMock()
    {
        return $this->getMock('\Symfony\Component\Templating\EngineInterface');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getCacheProviderMock()
    {
        $cache = $this->getMockBuilder('Doctrine\Common\Cache\CacheProvider')
            ->disableOriginalConstructor()
            ->setMethods(
                [
                    'fetch',
                    'save',
                ]
            )
            ->getMockForAbstractClass();

        $cache
            ->expects($this->any())
            ->method('fetch')
            ->willReturn(false);

        return $cache;
    }

    /**
     * Create config on file system mock.
     */
    protected function createConfig()
    {
        $config = $this->getConfigData();

        $structure = [
            'config' => [
                'test.yml' => $config,
            ],
        ];

        $this->root = vfsStream::setup(
            'root',
            null,
            $structure
        );
    }

    /**
     * @param string $name
     * @param string $content
     */
    protected function addMockFile($name, $content = '')
    {
        $file = $this->root->newFile($name);
        $file->setContent($content);
    }

    protected function getRequestMock()
    {
        return $this->getMock('Symfony\Component\HttpFoundation\Request');
    }

    /**
     * @return string
     */
    private function getConfigData()
    {
        return <<<EOT
prod:
    cache:
        enabled: true
stage: []

test: []
dev:
    cache:
        enabled: false
EOT;
    }
}

class ConfigMock extends Data implements ConfigInterface
{
    /**
     * Add named property to config object
     * and insert config as array.
     *
     * @param string $name name of property
     * @param string $file string $file absolute filepath/filename.ending
     */
    public function addconfig($name, $file)
    {
        $this->setByArray($file);
    }

    /**
     * Add config to data storage.
     *
     * @param string $file absolute filepath/filename.ending
     */
    public function setConfig($file)
    {
        $this->setByArray($file);
    }

    /**
     * Read config file via YAML parser.
     *
     * @param string $file absolute filepath/filename.ending
     * @return array  config array
     */
    public function readConfig($file)
    {
        $this->setByArray($file);
    }
}
