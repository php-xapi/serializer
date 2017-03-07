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

use Xabbuh\XApi\Model\Activity;

/**
 * @author Jérôme Parmentier <jerome.parmentier@acensi.fr>
 */
abstract class ActivitySerializerTest extends SerializerTest
{
    private $activitySerializer;

    protected function setUp()
    {
        $this->activitySerializer = $this->createActivitySerializer();
    }

    /**
     * @dataProvider serializeData
     */
    public function testSerializeActivity(Activity $activity, $expectedJson)
    {
        $this->assertJsonStringEqualsJsonString($expectedJson, $this->activitySerializer->serializeActivity($activity));
    }

    public function serializeData()
    {
        return $this->buildSerializeTestCases('Activity');
    }

    /**
     * @dataProvider deserializeData
     */
    public function testDeserializeActivity($json, Activity $expectedActivity)
    {
        $activity = $this->activitySerializer->deserializeActivity($json);

        $this->assertInstanceOf('Xabbuh\XApi\Model\Activity', $activity);
        $this->assertTrue($expectedActivity->equals($activity), 'Deserialized activity has the expected properties');
    }

    public function deserializeData()
    {
        return $this->buildDeserializeTestCases('Activity');
    }

    abstract protected function createActivitySerializer();
}
