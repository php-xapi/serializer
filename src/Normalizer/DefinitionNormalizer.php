<?php

namespace Xabbuh\XApi\Serializer\Normalizer;

use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Xabbuh\XApi\Model\Definition;

/**
 * Denormalizes PHP arrays to {@link Definition} instances.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
final class DefinitionNormalizer implements DenormalizerInterface, SerializerAwareInterface
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

        $name = null;
        $description = null;
        $type = isset($data['type']) ? $data['type'] : null;
        $moreInfo = isset($data['moreInfo']) ? $data['moreInfo'] : null;

        if (isset($data['name'])) {
            $name = $this->serializer->denormalize($data['name'], 'Xabbuh\XApi\Model\LanguageMap', $format, $context);
        }

        if (isset($data['description'])) {
            $description = $this->serializer->denormalize($data['description'], 'Xabbuh\XApi\Model\LanguageMap', $format, $context);
        }

        return new Definition($name, $description, $type, $moreInfo);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return 'Xabbuh\XApi\Model\Definition' === $type;
    }
}
