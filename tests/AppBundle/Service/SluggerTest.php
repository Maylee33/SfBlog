<?php

namespace Tests\AppBundle\Util;

use AppBundle\Service\Slugger;
use PHPUnit\Framework\TestCase;

class SluggerTest extends TestCase
{
    public function testSlugify()
    {
        // On instancie la classe que l'on veut tester
        $slug = new Slugger();
        // On fait appel à la méthode à tester, avec un argument choisi (ici : "Hello World")
        $result = $slug->slugify('Hello World');
        // => retourne "hello-world"

        // On le compare donc au résultat reçu de la méthode slugify()
        // assert that your calculator added the numbers correctly!
        $this->assertEquals('hello-world', $result);
    }
}
