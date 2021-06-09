<?php

declare(strict_types=1);

namespace PhpCfdi\SatEstadoRetenciones;

class Scraper
{
    public const SAT_WEBAPP_URL = 'https://prodretencionverificacion.clouda.sat.gob.mx/Home/ConsultaRetencion';

    private HttpClientInterface $httpClient;

    private ResultConverter $resultConverter;

    public function __construct(HttpClientInterface $httpClient = null)
    {
        $this->httpClient = $httpClient ?? new PhpStreamContextHttpClient();
        $this->resultConverter = new ResultConverter();
    }

    public function getHttpClient(): HttpClientInterface
    {
        return $this->httpClient;
    }



    public function obtainStatus(RetentionQuery $query): RetentionResult
    {
        $url = $this->makeUrl($query);
        $html = $this->httpClient->getContents($url);
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
