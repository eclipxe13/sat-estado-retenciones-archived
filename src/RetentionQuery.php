<?php

declare(strict_types=1);

namespace PhpCfdi\SatEstadoRetenciones;

class RetentionQuery
{
    private string $uuid;

    private string $issuerRfc;

    private string $receiverRfc;

    public function __construct(string $uuid, string $rfcIssuer, string $rfcReceiver)
    {
        $this->uuid = $uuid;
        $this->issuerRfc = $rfcIssuer;
        $this->receiverRfc = $rfcReceiver;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getIssuerRfc(): string
    {
        return $this->issuerRfc;
    }

    public function getReceiverRfc(): string
    {
        return $this->receiverRfc;
    }
}
