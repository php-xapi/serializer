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

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Serializer as SymfonySerializer;
use Xabbuh\XApi\Serializer\Normalizer\ActorNormalizer;
use Xabbuh\XApi\Serializer\Normalizer\ContextActivitiesNormalizer;
use Xabbuh\XApi\Serializer\Normalizer\ContextNormalizer;
use Xabbuh\XApi\Serializer\Normalizer\DocumentDataNormalizer;
use Xabbuh\XApi\Serializer\Normalizer\ExtensionsNormalizer;
use Xabbuh\XApi\Serializer\Normalizer\FilterNullValueNormalizer;
use Xabbuh\XApi\Serializer\Normalizer\ObjectNormalizer;
use Xabbuh\XApi\Serializer\Normalizer\ResultNormalizer;
use Xabbuh\XApi\Serializer\Normalizer\StatementNormalizer;
use Xabbuh\XApi\Serializer\Normalizer\StatementResultNormalizer;
use Xabbuh\XApi\Serializer\Normalizer\TimestampNormalizer;

/**
 * Entry point to set up the {@link \Symfony\Component\Serializer\Serializer Symfony Serializer component}
 * for the Experience API.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
class Serializer
{
    /**
     * Creates a new Serializer.
     *
     * @return SerializerInterface The Serializer
     */
    public static function createSerializer()
    {
        $normalizers = array(
            new ActorNormalizer(),
            new ContextNormalizer(),
            new ContextActivitiesNormalizer(),
            new DocumentDataNormalizer(),
            new ExtensionsNormalizer(),
            new ObjectNormalizer(),
            new ResultNormalizer(),
            new StatementNormalizer(),
            new StatementResultNormalizer(),
            new TimestampNormalizer(),
            new ArrayDenormalizer(),
            new FilterNullValueNormalizer(new PropertyNormalizer()),
            new PropertyNormalizer(),
        );
        $encoders = array(
            new JsonEncoder(),
        );

        return new SymfonySerializer($normalizers, $encoders);
    }
}
