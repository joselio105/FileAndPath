<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use Plugse\Fp\File;

class FileTest extends TestCase
{
    private static $filename;
    private static $content;

    public static function setUpBeforeClass(): void
    {
        self::$filename = "./tests/files/txt/file.txt";
        self::$content = "Um conteúdo para testar";
    }

    public static function tearDownAfterClass(): void
    {
        unlink(self::$filename);
    }

    public function testReadAndWrite()
    {
        File::saveFile(self::$filename, self::$content);
        $contentRead = File::readFile(self::$filename);

        $this->assertEquals(self::$content, $contentRead);
    }
}
