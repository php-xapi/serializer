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

use Xabbuh\XApi\DataFixtures\StatementResultFixtures;
use Xabbuh\XApi\Serializer\Serializer;
use Xabbuh\XApi\Serializer\StatementResultSerializer;
use XApi\Fixtures\Json\StatementResultJsonFixtures;

/**
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
class StatementResultSerializerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var StatementResultSerializer
     */
    private $statementResultSerializer;

    protected function setUp()
    {
        $this->statementResultSerializer = new StatementResultSerializer(Serializer::createSerializer());
    }
    public function testDeserializeStatementResult()
    {
        $expectedResult = StatementResultFixtures::getStatementResult();
        $statementResult = $this->statementResultSerializer->deserializeStatementResult(
            StatementResultJsonFixtures::getStatementResult()
        );
        $statements = $statementResult->getStatements();

        $this->assertSame(count($expectedResult->getStatements()), count($statements));
        $this->assertSame($expectedResult->getMoreUrlPath(), $statementResult->getMoreUrlPath());

        foreach ($expectedResult->getStatements() as $index => $expectedStatement) {
            $this->assertTrue($expectedStatement->equals($statements[$index]));
        }
    }

    public function testSerializeMinimalStatement()
    {
        $statementResult = StatementResultFixtures::getStatementResult();

        $this->assertJsonStringEqualsJsonString(
            StatementResultJsonFixtures::getStatementResult(),
            $this->statementResultSerializer->serializeStatementResult($statementResult)
        );
    }

    public function testDeserializeStatementResultWithMore()
    {
        $expectedResult = StatementResultFixtures::getStatementResultWithMore();
        $statementResult = $this->statementResultSerializer->deserializeStatementResult(
            StatementResultJsonFixtures::getStatementResultWithMore()
        );
        $statements = $statementResult->getStatements();

        $this->assertSame(count($expectedResult->getStatements()), count($statements));
        $this->assertSame($expectedResult->getMoreUrlPath(), $statementResult->getMoreUrlPath());

        foreach ($expectedResult->getStatements() as $index => $expectedStatement) {
            $this->assertTrue($expectedStatement->equals($statements[$index]));
        }
    }

    public function testSerializeMinimalStatementWithMore()
    {
        $statementResult = StatementResultFixtures::getStatementResultWithMore();

        $this->assertJsonStringEqualsJsonString(
            StatementResultJsonFixtures::getStatementResultWithMore(),
            $this->statementResultSerializer->serializeStatementResult($statementResult)
        );
    }
}
