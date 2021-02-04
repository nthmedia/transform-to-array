<?php

namespace Nthmedia\TransformToArray\Tests;

use Nthmedia\TransformToArray\TransformToArray;
use PHPUnit\Framework\TestCase;

class TransformToArrayTest extends TestCase
{
    protected array $testData = [];

    public function setUp(): void
    {
        $stdClass = new \stdClass();
        $stdClass->name = 'The A-Team';
        $stdClass->team = [
            'Hannibal',
            'Face',
            'B.A.',
            'Murdock',
        ];

        $nestedClass = new \stdClass();
        $nestedClass->nested = $stdClass;

        $this->testData = [
            'Nested array' => [
                'name' => 'The A-Team',
                'team' => [
                    'Hannibal',
                    'Face',
                    'B.A.',
                    'Murdock',
                ]
            ],
            'Array casted to Object' => (object) [
                'name' => 'The A-Team',
                'team' => [
                    'Hannibal',
                    'Face',
                    'B.A.',
                    'Murdock',
                ]
            ],
            'Anonymous Object' => new class {
                public $name = 'The A-Team';
                public $team = [
                    'Hannibal',
                    'Face',
                    'B.A.',
                    'Murdock',
                ];
            },
            'StdClass' => $stdClass,
            'Nested Object' => $nestedClass,
            'String' => 'String',
            'Int' => 1,
        ];
    }

    /** @test */
    public function output_is_correct(): void
    {
        $this->assertSame([
            'Nested array' => [
                'name' => 'The A-Team',
                'team' => [
                    'Hannibal',
                    'Face',
                    'B.A.',
                    'Murdock',
                ]
            ],
            'Array casted to Object' => [
                'name' => 'The A-Team',
                'team' => [
                    'Hannibal',
                    'Face',
                    'B.A.',
                    'Murdock',
                ]
            ],
            'Anonymous Object' => [
                'name' => 'The A-Team',
                'team' => [
                    'Hannibal',
                    'Face',
                    'B.A.',
                    'Murdock',
                ]
            ],
            'StdClass' => [
                'name' => 'The A-Team',
                'team' => [
                    'Hannibal',
                    'Face',
                    'B.A.',
                    'Murdock',
                ]
            ],
            'Nested Object' => [
                'nested' => [
                    'name' => 'The A-Team',
                    'team' => [
                        'Hannibal',
                        'Face',
                        'B.A.',
                        'Murdock',
                    ]
                ],
            ],
            'String' => 'String',
            'Int' => 1,
        ], TransformToArray::convert($this->testData));
    }
}
