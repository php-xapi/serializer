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

use Xabbuh\XApi\Model\StateDocument;

/**
 * Serialize and deserialize {@link StateDocument state documents}
 *
 * @author Jérôme Parmentier <jerome.parmentier@acensi.fr>
 */
interface StateDocumentSerializerInterface
{
    /**
     * Serializes a state document into a JSON encoded string.
     *
     * @param StateDocument $stateDocument
     *
     * @return string The serialized state document
     */
    public function serializeStateDocument(StateDocument $stateDocument);

    /**
     * Parses a serialized state document.
     *
     * @param string $data The serialized state document
     *
     * @return StateDocument the parsed state document
     */
    public function deserializeStateDocument($data);
}
