<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use Plugse\Fp\Json;

class JsonTest extends TestCase
{
    private $filename;
    private $content;

    protected function setUp(): void
    {
        $this->filename = "./tests/files/log/file.log";
        $this->content = [
            [
                'id' => 1,
                'name' => "Fulano dos Santos",
                'description' => "Bla bla blá",
                'createdAt' => "[2023-05-10 -3]"
            ],
            [
                'id' => 2,
                'name' => "Beltrano da Silva",
                'description' => "Bla bla blá",
                'createdAt' => "[2023-05-10 -3]"
            ],
        ];
    }

    protected function tearDown(): void
    {
        unlink($this->filename);
    }

    public function testReadAndWrite()
    {
        Json::save($this->filename, $this->content);
        $contentRead = Json::read($this->filename);

        $this->assertEquals($this->content, $contentRead);
    }

    /* public function testReadAndWriteUpdating()
    {
        $contentToUpdate = [
            // [
                'id' => 3,
                'name' => "Ciclano de Souza",
                'description' => "Bla bla blá",
                'createdAt' => "[2023-05-10 -3]"
            // ]
        ];

        Json::save($this->filename, $contentToUpdate);
        $contentRead = Json::read($this->filename);

        $this->assertContains($contentToUpdate, $contentRead);
    } */
}
