<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use Plugse\Fp\Env;

class EnvTest extends TestCase
{
    private $filename;
    private $content;

    protected function setUp(): void
    {
        $this->filename = "./tests/files/env/file.env";
        $this->content = [
            'element1' => 'Element One',
            'element2' => 'Element Thwo',
            'element3' => 'Element Three',
        ];
    }

    protected function tearDown(): void
    {
        unlink($this->filename);
    }

    public function testReadAndWrite()
    {
        Env::save($this->filename, $this->content);
        $contentRead = Env::read($this->filename);

        $this->assertEquals($this->content, $contentRead);
    }
}
