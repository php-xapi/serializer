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
 * To be thrown when additional data is present that couldn't be interpreted.
 *
 * @author Jérôme Parmentier <jerome.parmentier@acensi.fr>
 */
class ExtraAttributesException extends DeserializationException
{
    public function __construct(array $missingAttributes, \Exception $previous = null)
    {
        $msg = sprintf('Extra attributes are not allowed ("%s" are unknown).', implode('", "', $missingAttributes));

        parent::__construct($msg, 0, $previous);
    }
}
