<?php

declare(strict_types=1);

namespace PhpCfdi\SatEstadoRetenciones;

class PhpStreamContextHttpClient implements HttpClientInterface
{
    public function getContents(string $url): string
    {
        return file_get_contents($url);
    }

}
