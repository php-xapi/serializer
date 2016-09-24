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

use Xabbuh\XApi\DataFixtures\StatementFixtures;
use Xabbuh\XApi\Model\Statement;
use Xabbuh\XApi\Serializer\Serializer;
use Xabbuh\XApi\Serializer\StatementSerializer;
use XApi\Fixtures\Json\StatementJsonFixtures;

/**
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
class StatementSerializerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var StatementSerializer
     */
    private $statementSerializer;

    protected function setUp()
    {
        $this->statementSerializer = new StatementSerializer(Serializer::createSerializer());
    }

    /**
     * @dataProvider statementProvider
     *
     * @param string    $serializedStatement
     * @param Statement $expectedStatement
     */
    public function testDeserializeStatement($serializedStatement, Statement $expectedStatement)
    {
        $statement = $this->statementSerializer->deserializeStatement($serializedStatement);

        $this->assertTrue($expectedStatement->equals($statement));
    }

    /**
     * @dataProvider statementProvider
     *
     * @param string    $expectedStatement
     * @param Statement $statement
     */
    public function testSerializeStatement($expectedStatement, Statement $statement)
    {
        $serializedStatement = $this->statementSerializer->serializeStatement($statement);

        $this->assertJsonStringEqualsJsonString($expectedStatement, $serializedStatement);
    }

    public function statementProvider()
    {
        return array(
            'minimal-statement' => array(
                StatementJsonFixtures::getMinimalStatement(),
                StatementFixtures::getMinimalStatement(),
            ),
            'typical-statement' => array(
                StatementJsonFixtures::getTypicalStatement(),
                StatementFixtures::getTypicalStatement(),
            ),
            'voiding-statement' => array(
                StatementJsonFixtures::getVoidingStatement(),
                StatementFixtures::getVoidingStatement('12345678-1234-5678-8234-567812345678'),
            ),
            'attachment-statement' => array(
                StatementJsonFixtures::getAttachmentStatement(),
                StatementFixtures::getAttachmentStatement(),
            ),
            'statement-with-group-actor' => array(
                StatementJsonFixtures::getStatementWithGroupActor(),
                StatementFixtures::getStatementWithGroupActor(),
            ),
            'statement-with-group-actor-without-members' => array(
                StatementJsonFixtures::getStatementWithGroupActorWithoutMembers(),
                StatementFixtures::getStatementWithGroupActorWithoutMembers(),
            ),
            'statement-reference' => array(
                StatementJsonFixtures::getStatementWithStatementRef(),
                StatementFixtures::getStatementWithStatementRef(),
            ),
            'statement-with-sub-statement' => array(
                StatementJsonFixtures::getStatementWithSubStatement(),
                StatementFixtures::getStatementWithSubStatement(),
            ),
            'statement-with-result' => array(
                StatementJsonFixtures::getStatementWithResult(),
                StatementFixtures::getStatementWithResult(),
            ),
            'statement-with-agent-authority' => array(
                StatementJsonFixtures::getStatementWithAgentAuthority(),
                StatementFixtures::getStatementWithAgentAuthority(),
            ),
            'statement-with-group-authority' => array(
                StatementJsonFixtures::getStatementWithGroupAuthority(),
                StatementFixtures::getStatementWithGroupAuthority(),
            ),
            'all-properties-statement' => array(
                StatementJsonFixtures::getAllPropertiesStatement(),
                StatementFixtures::getAllPropertiesStatement(),
            ),
        );
    }

    public function testDeserializeStatementCollection()
    {
        /** @var \Xabbuh\XApi\Model\Statement[] $statements */
        $statements = $this->statementSerializer->deserializeStatements(
            StatementJsonFixtures::getStatementCollection()
        );
        $expectedCollection = StatementFixtures::getStatementCollection();

        $this->assertSame(count($expectedCollection), count($statements));

        foreach ($expectedCollection as $index => $expectedStatement) {
            $this->assertTrue($expectedStatement->equals($statements[$index]));
        }
    }
}
