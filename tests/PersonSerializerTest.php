<?php

/*
 * This file is part of the xAPI package.
 *
 * (c) Christian Flothmann <christian.flothmann@xabbuh.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xabbuh\XApi\Serializer\Tests;

use Xabbuh\XApi\Model\Person;

/**
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
abstract class PersonSerializerTest extends SerializerTest
{
    private $personSerializer;

    protected function setUp()
    {
        $this->personSerializer = $this->createPersonSerializer();
    }

    /**
     * @dataProvider serializeData
     */
    public function testSerializeActor(Person $person, $expectedJson)
    {
        $this->assertJsonStringEqualsJsonString($expectedJson, $this->personSerializer->serializePerson($person));
    }

    public function serializeData()
    {
        return $this->buildSerializeTestCases('Person');
    }

    abstract protected function createPersonSerializer();
}
