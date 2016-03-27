<?php

namespace spec\Xabbuh\XApi\Serializer\Normalizer;

use PhpSpec\ObjectBehavior;
use Xabbuh\XApi\DataFixtures\AccountFixtures;
use XApi\Fixtures\Json\AccountJsonFixtures;

class AccountNormalizerSpec extends ObjectBehavior
{
    function it_is_a_normalizer()
    {
        $this->shouldHaveType('Symfony\Component\Serializer\Normalizer\NormalizerInterface');
    }

    function it_is_a_denormalizer()
    {
        $this->shouldHaveType('Symfony\Component\Serializer\Normalizer\DenormalizerInterface');
    }

    function it_normalizes_accounts()
    {
        $data = $this->normalize(AccountFixtures::getTypicalAccount());

        $data->shouldHaveCount(2);
        $data->shouldHaveKey('homePage');
        $data->shouldHaveKey('name');
        $data['homePage']->shouldBeEqualTo('https://tincanapi.com');
        $data['name']->shouldBeEqualTo('test');
    }

    function it_supports_normalizing_accounts()
    {
        $this->supportsNormalization(AccountFixtures::getTypicalAccount())->shouldBe(true);
    }

    function it_denormalizes_accounts()
    {
        $account = $this->denormalize(array('homePage' => 'https://tincanapi.com', 'name' => 'test'), 'Xabbuh\XApi\Model\Account');

        $account->shouldBeAnInstanceOf('Xabbuh\XApi\Model\Account');
        $account->getHomePage()->shouldReturn('https://tincanapi.com');
        $account->getName()->shouldReturn('test');
    }

    function it_supports_denormalizing_accounts()
    {
        $this->supportsDenormalization(AccountJsonFixtures::getTypicalAccount(), 'Xabbuh\XApi\Model\Account')->shouldBe(true);
    }
}
