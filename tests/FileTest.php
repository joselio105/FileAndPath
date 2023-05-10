<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use Plugse\Fp\File;

class FileTest extends TestCase
{
    public function testReadAndWrite()
    {
        $filename = "./tests/files/txt/file.txt";
        $content = "Um conteúdo para testar";

        File::saveFile($filename, $content);
        $contentRead = File::readFile($filename);

        unlink($filename);

        $this->assertEquals($content, $contentRead);
    }
}
