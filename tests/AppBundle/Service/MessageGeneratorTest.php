<?php

namespace Tests\AppBundle\Util;

use AppBundle\Service\MessageGenerator;
use PHPUnit\Framework\TestCase;

class MessageGeneratorTest extends TestCase
{
    public function testgetHappyMessage()
    {
        $generator = new MessageGenerator();
        $result = $generator->getHappyMessage();

        // On va simplement vérifier que cela nous retourne une chaine de caractères (type = string)
        // $this->assertStringMatchesFormat('%s', $result);
        $this->assertInternalType('string', $result);
    }
}
