<?php

namespace Xabbuh\XApi\Serializer\Normalizer;

use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Xabbuh\XApi\Model\Verb;

/**
 * Denormalizes PHP arrays to {@link Verb} objects.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
final class VerbNormalizer implements DenormalizerInterface, SerializerAwareInterface
{
    private $serializer;

    /**
     * {@inheritdoc}
     */
    public function setSerializer(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (!$this->serializer instanceof DenormalizerInterface) {
            throw new LogicException('Cannot denormalize because the injected serializer is not a denormalizer.');
        }

        $display = null;

        if (isset($data['display'])) {
            $display = $this->serializer->denormalize($data['display'], 'Xabbuh\XApi\Model\LanguageMap', $format, $context);
        }

        return new Verb($data['id'], $display);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return 'Xabbuh\XApi\Model\Verb' === $type;
    }
}
