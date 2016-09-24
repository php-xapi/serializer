<?php

/*
 * This file is part of the xAPI package.
 *
 * (c) Christian Flothmann <christian.flothmann@xabbuh.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xabbuh\XApi\Serializer\Normalizer;

use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Xabbuh\XApi\Model\Attachment;

/**
 * Denormalizes PHP arrays to {@link Attachment} objects.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
final class AttachmentNormalizer implements DenormalizerInterface, SerializerAwareInterface
{
    private $serializer;

    public function setSerializer(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (!$this->serializer instanceof DenormalizerInterface) {
            throw new LogicException('Cannot denormalize because the injected serializer is not a denormalizer.');
        }

        $display = $this->serializer->denormalize($data['display'], 'Xabbuh\XApi\Model\LanguageMap', $format, $context);
        $description = null;
        $fileUrl = isset($data['fileUrl']) ? $data['fileUrl'] : null;

        if (isset($data['description'])) {
            $description = $this->serializer->denormalize($data['description'], 'Xabbuh\XApi\Model\LanguageMap', $format, $context);
        }

        return new Attachment($data['usageType'], $data['contentType'], $data['length'], $data['sha2'], $display, $description, $fileUrl);
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return 'Xabbuh\XApi\Model\Attachment' === $type;
    }
}
