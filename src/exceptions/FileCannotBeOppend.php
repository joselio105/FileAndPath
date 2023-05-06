<?php

namespace Plugse\FP\Exceptions;

use Exception;

class FileCannotBeOppend extends Exception
{
    public function __construct(string $filename)
    {
        http_response_code(404);
        parent::__construct("Erro: Falha ao abrir o arquivo '{$filename}'");
    }
}
