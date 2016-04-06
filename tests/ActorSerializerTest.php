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

use Xabbuh\XApi\DataFixtures\ActorFixtures;
use Xabbuh\XApi\Serializer\ActorSerializer;
use Xabbuh\XApi\Serializer\Serializer;
use XApi\Fixtures\Json\ActorJsonFixtures;

/**
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
class ActorSerializerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ActorSerializer
     */
    private $actorSerializer;

    protected function setUp()
    {
        $this->actorSerializer = new ActorSerializer(Serializer::createSerializer());
    }

    public function testDeserializeAgent()
    {
        $actor = $this->actorSerializer->deserializeActor(ActorJsonFixtures::getTypicalAgentWithType());

        $this->assertTrue(ActorFixtures::getTypicalAgent()->equals($actor));
    }

    public function testDeserializeAgentWithoutObjectType()
    {
        $actor = $this->actorSerializer->deserializeActor(ActorJsonFixtures::getTypicalAgent());

        $this->assertTrue(ActorFixtures::getTypicalAgent()->equals($actor));
    }

    public function testDeserializeGroup()
    {
        /** @var \Xabbuh\XApi\Model\Group $group */
        $group = $this->actorSerializer->deserializeActor(ActorJsonFixtures::getAllPropertiesAndTwoTypicalAgentMembersGroup());

        $this->assertTrue(ActorFixtures::getAllPropertiesAndTwoTypicalAgentMembersGroup()->equals($group));
    }

    public function testSerializeAgent()
    {
        $this->assertJsonStringEqualsJsonString(
            ActorJsonFixtures::getTypicalAgentWithType(),
            $this->actorSerializer->serializeActor(ActorFixtures::getTypicalAgent())
        );
    }

    public function testSerializeGroup()
    {
        $this->assertJsonStringEqualsJsonString(
            ActorJsonFixtures::getTypicalGroup(),
            $this->actorSerializer->serializeActor(ActorFixtures::getTypicalGroup())
        );
    }
}
