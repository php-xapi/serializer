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
 * @author Jérôme Parmentier <jerome.parmentier@acensi.fr>
 */
class UnsupportedStatementVersionException extends StatementDeserializationException
{
    public function __construct($version, \Exception $previous = null)
    {
        parent::__construct(sprintf('Statement version "%s" is not supported.', $version), 0, $previous);
    }
}
