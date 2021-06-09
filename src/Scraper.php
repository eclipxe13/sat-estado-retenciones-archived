<?php

declare(strict_types=1);

namespace PhpCfdi\SatEstadoRetenciones;

class Scraper
{
    public const SAT_WEBAPP_URL = 'https://prodretencionverificacion.clouda.sat.gob.mx/Home/ConsultaRetencion';

    private ResultConverter $resultConverter;

    public function __construct(ResultConverter $resultConverter = null)
    {
        $this->resultConverter = $resultConverter ?? new ResultConverter();
    }

    public function obtainStatus(RetentionQuery $query): RetentionResult
    {
        // build url
        $url = self::SAT_WEBAPP_URL . '?' . http_build_query([
            'folio' => $query->getUuid(),
            'rfcEmisor' => $query->getIssuerRfc(),
            'rfcReceptor' => $query->getReceiverRfc(),
            '_' => $this->obtainMillisecondsParameter(),
        ]);

        // get contents from url
        $html = file_get_contents($url);

        // convert html contents to result
        return $this->resultConverter->convertHtml($html);
    }

    public function obtainMillisecondsParameter(): int
    {
        return intval(microtime(true) * 1000);
    }
}
