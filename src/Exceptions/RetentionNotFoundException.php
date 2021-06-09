<?php

declare(strict_types=1);

namespace PhpCfdi\SatEstadoRetenciones\Exceptions;

use PhpCfdi\SatEstadoRetenciones\RetentionQuery;
use RuntimeException;
use Throwable;

final class RetentionNotFoundException extends RuntimeException implements SatEstadoRetencionesException
{
    private RetentionQuery $query;

    public function __construct(RetentionQuery $query, Throwable $previous = null)
    {
        $message = sprintf(
            'CFDI Retention %s (issuer: %s, receiver: %s) was not found',
            $query->getUuid(),
            $query->getIssuerRfc(),
            $query->getReceiverRfc() ?: '<empty>',
        );
        parent::__construct($message, 0, $previous);
        $this->query = $query;
    }

    public function getQuery(): RetentionQuery
    {
        return $this->query;
    }
}
