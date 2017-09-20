<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'admin',
        ));

        // Create a new entry in the database
        $crawler = $client->request('GET', '/post/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /post/");
        $crawler = $client->click($crawler->selectLink('Create a new post')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'appbundle_post[title]'  => 'Test title',
            'appbundle_post[summary]'  => 'Test summary',
            'appbundle_post[content]'  => 'Test content',
            'appbundle_post[imageUrl]'  => 'http://Test',
            'appbundle_post[author]'  => '31',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Test title")')->count(), 'Missing element td:contains("Test title")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Edit')->form(array(
            'appbundle_post[title]'  => 'Test title update',
            'appbundle_post[summary]'  => 'Test summary update',
            'appbundle_post[content]'  => 'Test content update',
            'appbundle_post[imageUrl]'  => 'http://Test update',
            'appbundle_post[author]'  => '32',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="Test title update"]')->count(), 'Missing element [value="Test title update"]');

        // Delete the entity
        // $client->submit($crawler->selectButton('Delete')->form());
        // $crawler = $client->followRedirect();
        //
        // // Check the entity has been delete on the list
        // $this->assertNotRegExp('/Test title update/', $client->getResponse()->getContent());
    }

}
