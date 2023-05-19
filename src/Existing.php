<?php

declare(strict_types=1);

namespace Plugse\Fp;

use Exception;

class Existing extends Exception
{
    public function __construct(string $filename)
    {
        http_response_code(409);
        parent::__construct("Erro: O arquivo '{$filename}' já existe");
    }
}
