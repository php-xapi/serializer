<?php

namespace spec\Xabbuh\XApi\Serializer\Normalizer;

use PhpSpec\ObjectBehavior;
use Xabbuh\XApi\DataFixtures\ActorFixtures;
use XApi\Fixtures\Json\ActorJsonFixtures;

class ActorNormalizerSpec extends ObjectBehavior
{
    function it_is_a_normalizer()
    {
        $this->shouldHaveType('Symfony\Component\Serializer\Normalizer\NormalizerInterface');
    }

    function it_is_a_denormalizer()
    {
        $this->shouldHaveType('Symfony\Component\Serializer\Normalizer\DenormalizerInterface');
    }

    function it_requires_an_iri_when_denormalizing_an_agent()
    {
        $this
            ->shouldThrow('\Symfony\Component\Serializer\Exception\InvalidArgumentException')
            ->during('denormalize', array(
                array('objectType' => 'Agent'),
                'Xabbuh\XApi\Model\Actor',
            ))
        ;
    }

    function it_supports_normalizing_agents()
    {
        $this->supportsNormalization(ActorFixtures::getTypicalAgent())->shouldBe(true);
    }

    function it_supports_normalizing_groups()
    {
        $this->supportsNormalization(ActorFixtures::getTypicalGroup())->shouldBe(true);
    }

    function it_supports_denormalizing_agents()
    {
        $this->supportsDenormalization(ActorJsonFixtures::getTypicalAgent(), 'Xabbuh\XApi\Model\Actor')->shouldBe(true);
    }

    function it_supports_denormalizing_groups()
    {
        $this->supportsDenormalization(ActorJsonFixtures::getTypicalGroup(), 'Xabbuh\XApi\Model\Actor')->shouldBe(true);
    }
}
