<?php

namespace Xabbuh\XApi\Serializer\Exception;

use Exception;

class UnsupportedVersionException extends StatementDeserializationException
{
    public function __construct($version, Exception $previous = null)
    {
        parent::__construct(sprintf('Statement version "%s" is not supported.', $version), 0, $previous);
    }
}
