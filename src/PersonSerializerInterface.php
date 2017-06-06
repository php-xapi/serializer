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

use Xabbuh\XApi\Model\Person;
use Xabbuh\XApi\Serializer\Exception\PersonSerializationException;

/**
 * Serialize {@link Person persons}.
 *
 * @author Jérôme Parmentier <jerome.parmentier@acensi.fr>
 */
interface PersonSerializerInterface
{
    /**
     * Serializes an person into a JSON encoded string.
     *
     * @param Person $person The person to serialize
     *
     * @throws PersonSerializationException When the serialization fails
     *
     * @return string The serialized person
     */
    public function serializePerson(Person $person);
}
