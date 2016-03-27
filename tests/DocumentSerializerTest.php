<?php

/*
 * This file is part of the xAPI package.
 *
 * (c) Christian Flothmann <christian.flothmann@xabbuh.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xabbuh\XApi\Serializer\Tests;

use Xabbuh\XApi\DataFixtures\DocumentFixtures;
use Xabbuh\XApi\Serializer\DocumentDataSerializer;
use Xabbuh\XApi\Serializer\Serializer;
use XApi\Fixtures\Json\DocumentJsonFixtures;

/**
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
class DocumentSerializerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DocumentDataSerializer
     */
    private $documentDataSerializer;

    protected function setUp()
    {
        $this->documentDataSerializer = new DocumentDataSerializer(Serializer::createSerializer());
    }

    public function testDeserializeDocumentData()
    {
        $documentData = $this->documentDataSerializer->deserializeDocumentData(DocumentJsonFixtures::getDocument());

        $this->assertInstanceOf('\Xabbuh\XApi\Model\DocumentData', $documentData);
        $this->assertEquals('foo', $documentData['x']);
        $this->assertEquals('bar', $documentData['y']);
    }

    public function testSerializeDocumentData()
    {
        $documentData = DocumentFixtures::getDocumentData();

        $this->assertJsonStringEqualsJsonString(
            DocumentJsonFixtures::getDocument(),
            $this->documentDataSerializer->serializeDocumentData($documentData)
        );
    }
}
