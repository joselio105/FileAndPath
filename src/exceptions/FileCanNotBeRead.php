<?php

namespace Plugse\FP\Exceptions;

use Exception;

class FileCanNotBeRead extends Exception
{
    public function __construct(string $filename)
    {
        http_response_code(404);
        parent::__construct("Erro: Falha ao ler o arquivo '{$filename}");
    }
}
