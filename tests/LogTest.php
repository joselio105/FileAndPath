<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use Plugse\Fp\Log;

class LogTest extends TestCase
{
    private $filename;
    private $content;

    protected function setUp(): void
    {
        $this->filename = "./tests/files/log/file.log";
        $this->content = [
            ['id', 'name', 'description', 'createdAt'],
            [1, "Fulano dos Santos", "Bla bla blá", "[2023-05-10 -3]"],
            [2, "Beltrano da Silva", "Bla bla blá", "[2023-05-10 -3]"],
            [3, "Ciclano de Souza", "Bla bla blá", "[2023-05-10 -3]"],
            [4, "Fulano dos Santos", "Bla bla blá", "[2023-05-10 -3]"],
            [5, "Beltrano da Silva", "Bla bla blá", "[2023-05-10 -3]"],
        ];
    }

    protected function tearDown(): void
    {
        unlink($this->filename);
    }
    public function testReadAndWrite()
    {
        Log::save($this->filename, $this->content);
        $contentRead = Log::read($this->filename);

        $this->assertEquals($this->content, $contentRead);
    }
}
