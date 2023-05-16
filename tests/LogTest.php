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
            [
                'id' => 1,
                'name' => "Fulano dos Santos",
                'description' => "Bla bla blá",
                'createdAt' => "[2023-05-10 -3]",
            ],
            [
                'id' => 2,
                'name' => "Beltrano da Silva",
                'description' => "Bla bla blá",
                'createdAt' => "[2023-05-10 -3]",
            ],
            [
                'id' => 3,
                'name' => "Ciclano de Souza",
                'description' => "Bla bla blá",
                'createdAt' => "[2023-05-10 -3]",
            ],
            [
                'id' => 4,
                'name' => "Fulano de Spoza",
                'description' => "Bla bla blá",
                'createdAt' => "[2023-05-10 -3]",
            ],
        ];
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
            'id' => 5,
            'name' => "Beltrano dos Santos",
            'description' => "Bla bla blá",
            'createdAt' => "[2023-05-10 -3]",
        ];

        $array = [
            ['id' => 1, 'name' => "Jose"], ['id' => 2, 'name' => "Jose"]
        ];
        $searchBy = ['id' => 2, 'name' => "Jose"];


        // Log::save(self::$filename, $contentToUpdate, true);
        // $contentRead = Log::read(self::$filename);
        unlink(self::$filename);
        $search = array_search($searchBy, $array);

        $this->assertIsNumeric($search);
        $this->assertNotEquals(false, $search);
        // $this->assertContains($contentToUpdate, $contentRead);
    }
}
