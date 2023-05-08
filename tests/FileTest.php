<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use Plugse\Fp\File;

class FilePathTest extends TestCase
{
    public function testReadAndWriteFile(): array
    {
        $content = [];
        foreach (file('tests/testing.txt') as $rowId => $row) {
            $fields = explode(' ## ', $row);
            foreach ($fields as $field) {
                [$key, $value] = explode('=', $field);
                $content[$rowId][$key] = $value;
            }
        }
        $filename = './tests/test.txt';

        File::saveFile($filename, $content[0]['description']);
        $contentRead = File::readFile($filename);
        unlink($filename);

        $this->assertEquals($content[0]['description'], $contentRead);

        return $content;
    }

    /**
     * @depends testReadAndWriteFile
     */
    public function testReadAndWriteFileJson(array $content): void
    {
        $filename = './tests/test.json';
        File::saveOnJsonFile($filename, $content);
        $contentRead = File::readJsonFile($filename);
        unlink($filename);

        $this->assertEquals($content, $contentRead);
    }

    /**
     * @depends testReadAndWriteFile
    */
    public function testReadAndWriteFileDotEnv(array $content): void
    {
        $filename = './tests/test.env';
        File::saveOnDotEnvFile($filename, $content[0]);
        $contentRead = File::readFromDotEnvFile($filename);
        unlink($filename);

        $this->assertEquals($content[0], $contentRead);
    }

    /**
     * @depends testReadAndWriteFile
     */
    public function testReadAndWriteFileLog(array $content): void
    {
        $filename = './tests/test.log';
        File::saveOnLogFile($filename, $content);
        $contentRead = File::readLogFile($filename);
        unlink($filename);

        $this->assertEquals($content, $contentRead);
    }
}
