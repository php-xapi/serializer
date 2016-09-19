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

use Xabbuh\XApi\Model\Activity;
use Xabbuh\XApi\Model\Object;
use Xabbuh\XApi\Model\Statement;
use Xabbuh\XApi\Model\StatementReference;
use Xabbuh\XApi\Model\SubStatement;

/**
 * Normalizes and denormalizes xAPI statement objects.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
final class ObjectNormalizer extends Normalizer
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = array())
    {
        if ($object instanceof Activity) {
            $activityData = array(
                'objectType' => 'Activity',
                'id' => $object->getId(),
            );

            if (null !== $definition = $object->getDefinition()) {
                $activityData['definition'] = $this->normalizeAttribute($definition, $format, $context);
            }

            return $activityData;
        }

        if ($object instanceof StatementReference) {
            return array(
                'objectType' => 'StatementRef',
                'id' => $object->getStatementId(),
            );
        }

        if ($object instanceof SubStatement) {
            $subStatement = new Statement($object->getId(), $object->getActor(), $object->getVerb(), $object->getObject(), $object->getResult());
            $subStatementData = $this->normalizeAttribute($subStatement, $format, $context);
            $subStatementData['objectType'] = 'SubStatement';

            return $subStatementData;
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Object;
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (!isset($data['objectType']) || 'Activity' === $data['objectType']) {
            return $this->denormalizeActivity($data, $format, $context);
        }

        if (isset($data['objectType']) && ('Agent' === $data['objectType'] || 'Group' === $data['objectType'])) {
            return $this->denormalizeData($data, 'Xabbuh\XApi\Model\Actor', $format, $context);
        }

        if (isset($data['objectType']) && 'SubStatement' === $data['objectType']) {
            return $this->denormalizeSubStatement($data, $format, $context);
        }

        if (isset($data['objectType']) && 'StatementRef' === $data['objectType']) {
            return new StatementReference($data['id']);
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return 'Xabbuh\XApi\Model\Activity' === $type || 'Xabbuh\XApi\Model\Object' === $type || 'Xabbuh\XApi\Model\StatementReference' === $type || 'Xabbuh\XApi\Model\SubStatement' === $type;
    }

    private function denormalizeActivity(array  $data, $format = null, array $context = array())
    {
        $definition = null;

        if (isset($data['definition'])) {
            $definition = $this->denormalizeData($data['definition'], 'Xabbuh\XApi\Model\Definition', $format, $context);
        }

        return new Activity($data['id'], $definition);
    }

    private function denormalizeSubStatement(array  $data, $format = null, array $context = array())
    {
        $statementData = array(
            'actor' => $data['actor'],
            'verb' => $data['verb'],
            'object' => $data['object'],
        );

        if (isset($data['result'])) {
            $statementData['result'] = $data['result'];
        }

        /** @var Statement $statement */
        $statement = $this->denormalizeData($statementData, 'Xabbuh\XApi\Model\Statement', $format, $context);

        return new SubStatement(null, $statement->getActor(), $statement->getVerb(), $statement->getObject(), $statement->getResult());
    }
}
