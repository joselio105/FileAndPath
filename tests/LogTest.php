<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use Plugse\Fp\Log;

class LogTest extends TestCase
{
    private static $filename;
    private static $content;

    public static function setUpBeforeClass(): void
    {
        self::$filename = "./tests/files/log/file.log";
        self::$content = [
            ['id', 'name', 'description', 'createdAt'],
            [1, "Fulano dos Santos", "Bla bla blá", "[2023-05-10 -3]"],
            [2, "Beltrano da Silva", "Bla bla blá", "[2023-05-10 -3]"],
            [3, "Ciclano de Souza", "Bla bla blá", "[2023-05-10 -3]"],
            [4, "Fulano dos Santos", "Bla bla blá", "[2023-05-10 -3]"]        ];
    }

    public static function tearDownAfterClass(): void
    {
        unlink(self::$filename);
    }
    public function testReadAndWrite()
    {
        Log::save(self::$filename, self::$content);
        $contentRead = Log::read(self::$filename);

        $this->assertEquals(self::$content, $contentRead);
    }

    public function testeReadAndWriteUpdating()
    {
        $contentToUpdate = [
            ['id', 'name', 'description', 'createdAt'],
            [5, "Beltrano da Silva", "Bla bla blá", "[2023-05-10 -3]"]
        ];

        Log::save(self::$filename, $contentToUpdate, true);
        $contentRead = Log::read(self::$filename);

        $this->assertContains($contentToUpdate, $contentRead);
    }
}
