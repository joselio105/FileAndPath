<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use Plugse\Fp\Env;

class EnvTest extends TestCase
{
    private static $filename;
    private static $content;

    public static function setUpBeforeClass(): void
    {
        self::$filename = "./tests/files/env/file.env";
        self::$content = [
            'element1' => 'Element One',
            'element2' => 'Element Thwo',
            'element3' => 'Element Three',
        ];
    }

    public function testReadAndWrite()
    {
        Env::save(self::$filename, self::$content);
        $contentRead = Env::read(self::$filename);

        $this->assertEquals(self::$content, $contentRead);
    }

    public function testeReadAndWriteUpdating()
    {
        $contentToUpdate = [
            'element4' => 'Element Four'
        ];

        Env::save(self::$filename, $contentToUpdate, true);
        $contentRead = Env::read(self::$filename);
        unlink(self::$filename);

        foreach ($contentToUpdate as $key => $value) {
            self::$content[$key] = $value;
            $this->assertArrayHasKey($key, $contentRead);
        }
    }

    public function testReadAndWriteUpdatingANewFile()
    {
        $filename = "./tests/files/log/newFile.log";
        Env::save($filename, self::$content, true);
        $contentRead = Env::read($filename);
        unlink($filename);

        $this->assertEquals(self::$content, $contentRead);
    }
}
