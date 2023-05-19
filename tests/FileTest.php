<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use Plugse\Fp\Exceptions\FileAlreadyExists;
use Plugse\FP\Exceptions\FileNotFound;
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
        $this->expectException(FileAlreadyExists::class);
        File::saveFile(self::$filename, self::$content);
        File::saveFile(self::$filename, self::$content);
    }

    public function testFileNotFound()
    {
        $this->expectException(FileNotFound::class);
        File::readFile('notfoud.txt');
    }
}
