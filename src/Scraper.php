<?php

declare(strict_types=1);

namespace PhpCfdi\SatEstadoRetenciones;

class Scraper
{
    public const SAT_WEBAPP_URL = 'https://prodretencionverificacion.clouda.sat.gob.mx/Home/ConsultaRetencion';

    private ResultConverter $resultConverter;

    public function __construct()
    {
        $this->resultConverter = new ResultConverter();
    }

    public function obtainStatus(RetentionQuery $query): RetentionResult
    {
        $url = $this->makeUrl($query);
        $html = file_get_contents($url);
        return $this->resultConverter->convertHtml($html);
    }

    public function makeUrl(RetentionQuery $query): string
    {
        return self::SAT_WEBAPP_URL . '?' . http_build_query([
            'folio' => $query->getUuid(),
            'rfcEmisor' => $query->getIssuerRfc(),
            'rfcReceptor' => $query->getReceiverRfc(),
            '_' => $this->obtainMillisecondsParameter(),
        ]);
    }

    public function obtainMillisecondsParameter(float $microtime = null): int
    {
        $microtime = $microtime ?? microtime(true);
        return intval($microtime * 1000);
    }
}
