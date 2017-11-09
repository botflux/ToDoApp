<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 02/11/2017
 * Time: 13:50
 */

namespace Todo\Tests;

use Silex\WebTestCase;

class AppTest extends WebTestCase
{
    /**
     * @dataProvider provideUrls
     */
    public function testPageIsSuccessful($url)
    {
        $client = $this->createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function createApplication()
    {
        $app = new \Silex\Application();

        require __DIR__ . '/../../app/config/dev.php';
        require __DIR__ . '/../../app/app.php';
        require __DIR__ . '/../../app/routes.php';

        unset($app['exception_handler']);
        $app['session.test'] = true;

        return $app;
    }

    public function provideUrls()
    {
        return [
            ['/login'],
            ['/register'],
            ['/'],
        ];
    }
}