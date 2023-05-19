<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use Plugse\Fp\Errors\Existing;
use Plugse\Fp\Errors\NotFound;
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

    public function testeReadAndWriteUpdating()
    {
        $contentToUpdate = "Mais um conteúdo";

        File::saveFile(self::$filename, $contentToUpdate, true);
        $contentRead = File::readFile(self::$filename);
        unlink(self::$filename);

        $this->assertStringContainsString($contentToUpdate, $contentRead);
    }

    public function testReadAndWriteUpdatingANewFile()
    {
        $filename = "./tests/files/txt/newFile.txt";

        File::saveFile($filename, self::$content);
        $contentRead = File::readFile($filename);
        unlink($filename);

        $this->assertEquals(self::$content, $contentRead);
    }

    public function testFileAlreadyExists()
    {
        $exception = new Existing(self::$filename);
        $this->expectException(get_class($exception));
        File::saveFile(self::$filename, self::$content);
        File::saveFile(self::$filename, self::$content);
    }

    public function testFileNotFound()
    {
        $exception = new NotFound(self::$filename);
        $this->expectException(get_class($exception));
        File::readFile('notfoud.txt');
    }
}
