<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use Plugse\Fp\File;

class FileTest extends TestCase
{
    private $filename;
    private $content;

    protected function setUp(): void
    {
        $this->filename = "./tests/files/txt/file.txt";
        $this->content = "Um conteúdo para testar";
    }

    protected function tearDown(): void
    {
        unlink($this->filename);
    }

    public function testReadAndWrite()
    {
        File::saveFile($this->filename, $this->content);
        $contentRead = File::readFile($this->filename);

        $this->assertEquals($this->content, $contentRead);
    }
}
