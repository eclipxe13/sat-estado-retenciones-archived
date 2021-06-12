<?php

declare(strict_types=1);

namespace PhpCfdi\SatEstadoRetenciones;

interface ScraperInterface
{
    /**
     * Consumes the web page to obtain the information about a CFDI Retentions document
     *
     * @param Parameters $parameters
     * @return Result
     * @throws Exceptions\RetentionNotFoundException if retention document was not found
     * @throws Exceptions\HttpClientException if unable to retrieve contents because HTTP error
     */
    public function obtainStatus(Parameters $parameters): Result;
}
