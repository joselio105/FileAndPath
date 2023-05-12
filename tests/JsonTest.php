<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use Plugse\Fp\Json;

class JsonTest extends TestCase
{
    private static $filename;
    private static $content;

    public static function setUpBeforeClass(): void
    {
        self::$filename = "./tests/files/json/file.json";
        self::$content = [
            [
                'id' => 1,
                'name' => "Fulano dos Santos",
                'description' => "Bla bla blá",
                'createdAt' => "[2023-05-10 -3]"
            ],
            [
                'id' => 2,
                'name' => "Beltrano da Silva",
                'description' => "Bla bla blá",
                'createdAt' => "[2023-05-10 -3]"
            ],
        ];
    }

    public static function tearDownAfterClass(): void
    {
        unlink(self::$filename);
    }

    public function testReadAndWrite()
    {
        Json::save(self::$filename, self::$content);
        $contentRead = Json::read(self::$filename);

        $this->assertEquals(self::$content, $contentRead);
    }

    public function testReadAndWriteUpdating()
    {
        $contentToUpdate = [
            'id' => 3,
            'name' => "Ciclano de Souza",
            'description' => "Bla bla blá",
            'createdAt' => "[2023-05-10 -3]"
        ];

        Json::save(self::$filename, $contentToUpdate, true);
        $contentRead = Json::read(self::$filename);

        $this->assertContains($contentToUpdate, $contentRead);
    }
}
