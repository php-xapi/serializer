<?php

/*
 * This file is part of the xAPI package.
 *
 * (c) Christian Flothmann <christian.flothmann@xabbuh.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xabbuh\XApi\Serializer;

use Xabbuh\XApi\Model\Activity;
use Xabbuh\XApi\Serializer\Exception\ActivityDeserializationException;
use Xabbuh\XApi\Serializer\Exception\ActivitySerializationException;

/**
 * Serialize and deserialize {@link Activity activities}.
 *
 * @author Jérôme Parmentier <jerome.parmentier@acensi.fr>
 */
interface ActivitySerializerInterface
{
    /**
     * Serializes an activity into a JSON encoded string.
     *
     * @param Activity $activity The activity to serialize
     *
     * @throws ActivitySerializationException When the serialization fails
     *
     * @return string The serialized activity
     */
    public function serializeActivity(Activity $activity);

    /**
     * Parses a serialized activity.
     *
     * @param string $data The serialized activity
     *
     * @throws ActivityDeserializationException When the deserialization fails
     *
     * @return Activity The parsed activity
     */
    public function deserializeActivity($data);
}
