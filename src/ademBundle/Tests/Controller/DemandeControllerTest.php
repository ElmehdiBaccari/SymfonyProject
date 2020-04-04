<?php

namespace ademBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DemandeControllerTest extends WebTestCase
{
    public function testAjouterdemande()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/AjouterDemande');
    }

    public function testGererdemande()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/GererDemande');
    }

    public function testAfficherdemande()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/AfficherDemande');
    }

}
