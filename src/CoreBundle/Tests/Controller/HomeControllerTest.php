<?php
namespace CoreBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class HomeControllerTest
 *
 * @package CoreBundle\Tests\Controller
 * @author Marc Aschmann <maschmann@gmail.com>
 */
class HomeControllerTest extends WebTestCase
{
    /**
     * testing index
     */
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}
