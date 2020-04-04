<?php

namespace EspritApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    public function testAll()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/all');
    }

    public function testFind()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/find');
    }

    public function testNew()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/new');
    }

    public function testLivre()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/livre');
    }

    public function testEmprunt()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/emprunt');
    }

}
