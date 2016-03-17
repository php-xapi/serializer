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

use Xabbuh\XApi\Model\Statement;

/**
 * Normalizes and denormalizes xAPI statements.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
final class StatementNormalizer extends Normalizer
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = array())
    {
        if (!$object instanceof Statement) {
            return null;
        }

        $data = array(
            'actor' => $this->normalizeAttribute($object->getActor()),
            'verb' => $this->normalizeAttribute($object->getVerb()),
            'object' => $this->normalizeAttribute($object->getObject()),
        );

        if (null !== $id = $object->getId()) {
            $data['id'] = $id;
        }

        if (null !== $authority = $object->getAuthority()) {
            $data['authority'] = $this->normalizeAttribute($authority);
        }

        if (null !== $result = $object->getResult()) {
            $data['result'] = $this->normalizeAttribute($result);
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Statement;
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $id = isset($data['id']) ? $data['id'] : null;
        $actor = $this->denormalizeData($data['actor'], 'Xabbuh\XApi\Model\Actor', $format, $context);
        $verb = $this->denormalizeData($data['verb'], 'Xabbuh\XApi\Model\Verb', $format, $context);
        $object = $this->denormalizeData($data['object'], 'Xabbuh\XApi\Model\Object', $format, $context);
        $result = null;
        $authority = null;

        if (isset($data['result'])) {
            $result = $this->denormalizeData($data['result'], 'Xabbuh\XApi\Model\Result', $format, $context);
        }

        if (isset($data['authority'])) {
            $authority = $this->denormalizeData($data['authority'], 'Xabbuh\XApi\Model\Actor', $format, $context);
        }

        return new Statement($id, $actor, $verb, $object, $result, $authority);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return 'Xabbuh\XApi\Model\Statement' === $type;
    }
}
