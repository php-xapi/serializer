<?php

namespace spec\Xabbuh\XApi\Serializer\Normalizer;

use PhpSpec\ObjectBehavior;

class AttachmentNormalizerSpec extends ObjectBehavior
{
    function it_is_a_denormalizer()
    {
        $this->shouldHaveType('Symfony\Component\Serializer\Normalizer\DenormalizerInterface');
    }

    function it_supports_denormalizing_to_attachment_objects()
    {
        $this->supportsDenormalization(array(), 'Xabbuh\XApi\Model\Attachment')->shouldReturn(true);
    }
}
