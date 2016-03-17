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

use Xabbuh\XApi\Model\Account;
use Xabbuh\XApi\Model\Actor;
use Xabbuh\XApi\Model\Agent;
use Xabbuh\XApi\Model\Group;

/**
 * Normalizes and denormalizes xAPI statement actors.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
final class ActorNormalizer extends Normalizer
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = array())
    {
        if (!$object instanceof Actor) {
            return null;
        }

        $data = array();

        if (null !== $mbox = $object->getMbox()) {
            $data['mbox'] = $mbox;
        }

        if (null !== $mboxSha1Sum = $object->getMboxSha1Sum()) {
            $data['mbox_sha1sum'] = $mboxSha1Sum;
        }

        if (null !== $openId = $object->getOpenId()) {
            $data['openid'] = $openId;
        }

        if (null !== $account = $object->getAccount()) {
            $data['account'] = $this->normalizeAttribute($account);
        }

        if (null !== $name = $object->getName()) {
            $data['name'] = $name;
        }

        if ($object instanceof Group) {
            $data['member'] = array();

            foreach ($object->getMembers() as $member) {
                $data['member'][] = $this->normalize($member);
            }

            $data['objectType'] = 'Group';
        } else {
            $data['objectType'] = 'Agent';
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Actor;
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $mbox = isset($data['mbox']) ? $data['mbox'] : null;
        $mboxSha1Sum = isset($data['mboxSha1Sum']) ? $data['mboxSha1Sum'] : null;
        $openId = isset($data['openid']) ? $data['openid'] : null;
        $name = isset($data['name']) ? $data['name'] : null;
        $account = $this->denormalizeAccount($data, $format, $context);

        if (isset($data['objectType']) && 'Group' === $data['objectType']) {
            return $this->denormalizeGroup($mbox, $mboxSha1Sum, $openId, $account, $name, $data, $format, $context);
        }

        return new Agent($mbox, $mboxSha1Sum, $openId, $account, $name);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return 'Xabbuh\XApi\Model\Actor' === $type;
    }

    private function denormalizeAccount($data, $format = null, array $context = array())
    {
        if (!isset($data['account'])) {
            return null;
        }

        return $this->denormalizeData($data['account'], 'Xabbuh\XApi\Model\Account', $format,$context);
    }

    private function denormalizeGroup($mbox, $mboxSha1Sum, $openId, Account $account = null, $name, $data, $format = null, array $context = array())
    {
        $members = array();

        if (isset($data['member'])) {
            foreach ($data['member'] as $member) {
                $members[] = $this->denormalize($member, 'Xabbuh\XApi\Model\Agent', $format, $context);
            }
        }

        return new Group($mbox, $mboxSha1Sum, $openId, $account, $name, $members);
    }
}
