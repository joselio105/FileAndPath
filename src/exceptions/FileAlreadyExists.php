<?php

declare(strict_types=1);

namespace Plugse\FP\Exceptions;

use Exception;

class FileAlreadyExists extends Exception
{
    public function __construct(string $filename)
    {
        http_response_code(404);
        parent::__construct("Erro: O arquivo '{$filename}' já existe");
    }
}
