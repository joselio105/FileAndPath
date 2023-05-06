<?php

namespace Plugse\FP\Exceptions;

use Exception;

class FileCannotBeWritten extends Exception
{
    public function __construct(string $filename)
    {
        http_response_code(404);
        parent::__construct("Erro: Não foi possível escrever no arquivo ($filename)");
    }
}
