<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use Plugse\Fp\Env;

class EnvTest extends TestCase
{
    public function testReadAndWrite()
    {
        $filename = "./tests/files/env/file.env";
        $content = [
            'element1' => 'Element One',
            'element2' => 'Element Thwo',
            'element3' => 'Element Three',
        ];

        Env::save($filename, $content);
        $contentRead = Env::read($filename);

        unlink($filename);

        $this->assertEquals($content, $contentRead);
    }
}
