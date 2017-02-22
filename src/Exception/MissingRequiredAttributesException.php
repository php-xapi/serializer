<?php

/*
 * This file is part of the xAPI package.
 *
 * (c) Christian Flothmann <christian.flothmann@xabbuh.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xabbuh\XApi\Serializer\Exception;

/**
 * MissingRequiredAttributesException.
 *
 * @author Jérôme Parmentier <jerome.parmentier@acensi.fr>
 */
class MissingRequiredAttributesException extends DeserializationException
{
    public function __construct(array $missingAttributes, \Exception $previous = null)
    {
        $msg = sprintf('Following missing attributes are required : "%s".', implode('", "', $missingAttributes));

        parent::__construct($msg, 0, $previous);
    }
}
