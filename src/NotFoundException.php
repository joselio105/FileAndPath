<?php

declare(strict_types=1);

namespace Plugse\Fp;

use Exception;

class NotFoundException extends Exception
{
    public function __construct(string $filename)
    {
        http_response_code(404);
        parent::__construct("Erro: O arquivo '{$filename}' não foi encontrado");
    }
}
