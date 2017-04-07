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

use Xabbuh\XApi\Model\StateDocument;

/**
 * @author Jérôme Parmentier <jerome.parmentier@acensi.fr>
 */
abstract class StateDocumentSerializerTest extends SerializerTest
{
    private $stateDocumentSerializer;

    protected function setUp()
    {
        $this->stateDocumentSerializer = $this->createStateDocumentSerializer();
    }

    /**
     * @dataProvider serializeData
     */
    public function testSerializeStateDocument(StateDocument $stateDocument, $expectedJson)
    {
        $this->assertJsonStringEqualsJsonString($expectedJson, $this->stateDocumentSerializer->serializeStateDocument($stateDocument));
    }

    public function serializeData()
    {
        return $this->buildSerializeTestCases('StateDocument');
    }

    /**
     * @dataProvider deserializeData
     */
    public function testDeserializeStateDocument($json, StateDocument $expectedStateDocument)
    {
        $stateDocument = $this->stateDocumentSerializer->deserializeStateDocument($json);

        $this->assertInstanceOf('Xabbuh\XApi\Model\StateDocument', $stateDocument);
        $this->assertTrue($expectedStateDocument->equals($stateDocument), 'Deserialized state document has the expected properties');
    }

    public function deserializeData()
    {
        return $this->buildDeserializeTestCases('StateDocument');
    }

    abstract protected function createStateDocumentSerializer();
}
