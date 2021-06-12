# phpcfdi/sat-estado-retenciones

[![Source Code][badge-source]][source]
[![Latest Version][badge-release]][release]
[![Software License][badge-license]][license]
[![Build Status][badge-build]][build]
[![Scrutinizer][badge-quality]][quality]
[![Coverage Status][badge-coverage]][coverage]
[![Total Downloads][badge-downloads]][downloads]

> Consulta el estado de un CFDI de Retenciones haciendo scrap del sitio del SAT

:us: The documentation of this project is in spanish as this is the natural language for the intended audience.

## Acerca de phpcfdi/sat-estado-retenciones

El Servicio de Administración Tributaria en México (SAT) expone algunos servicios para la comprobación fiscal.

Para el caso de *CFDI regulares* (CFDI de ingresos, egresos, traslados y nómina) ofrece un web service de tipo
SOAP para poder conocer el estado (vigente o cancelado) de un CFDI.

Para el caso de *CFDI de Retenciones e Información de Pagos (CFDI de retenciones) no ofrece un web service.
El SAT solo permite consultar su estado a través de una página de internet ubicada en <https://prodretencionverificacion.clouda.sat.gob.mx/>
y aparentemente protegida por un *captcha*.

Esta librería permite aprovechar que la herramienta del SAT tiene una incorrecta implementación del *captcha*
y consulta no hay necesidad de resolverlo. Además, convierte la respuesta de la página de internet a propiedades
de un objeto.

## Instalación

Usa [composer](https://getcomposer.org/)

```shell
composer require phpcfdi/sat-estado-retenciones
```

## Uso básico

```php
<?php

use PhpCfdi\SatEstadoRetenciones\Exceptions\HttpClientException;
use PhpCfdi\SatEstadoRetenciones\Exceptions\RetentionNotFoundException;
use PhpCfdi\SatEstadoRetenciones\Service;

$contents = file_get_contents('archivo-de-retenciones.xml');

$service = new Service();
$parameters = $service->makeParametersFromXml($contents);

try {
    $result = $service->queryOrNull($parameters);
} catch (RetentionNotFoundException $exception) {
    echo "El CFDI de retenciones {$exception->getParameters()->getUuid()} no fue encontrado.\n";
    return;
} catch (HttpClientException $exception) {
    echo "No se pudo conectar al servicio en la URL {$exception->getUrl()}.\n";
    return;
}

if ($result->getStatusDocument()->isActive()) {
    echo "El CFDI de retenciones {$result->getUUID()} de {$result->getReceiverName()} se encuentra ACTIVO.\n";
}
```

## Explicación de objetos

TODO: Explicar Servicio, Scraper, Parameters, Result y HttpClientInterface

## Explicación de exceciones

## Soporte

Puedes obtener soporte abriendo un ticket en Github.

Adicionalmente, esta librería pertenece a la comunidad [PhpCfdi](https://www.phpcfdi.com), así que puedes usar los
mismos canales de comunicación para obtener ayuda de algún miembro de la comunidad.

## Compatibilidad

Esta librería se mantendrá compatible con al menos la versión con
[soporte activo de PHP](https://www.php.net/supported-versions.php) más reciente.

También utilizamos [Versionado Semántico 2.0.0](docs/SEMVER.md) por lo que puedes usar esta librería
sin temor a romper tu aplicación.

## Contribuciones

Las contribuciones con bienvenidas. Por favor lee [CONTRIBUTING][] para más detalles
y recuerda revisar el archivo de tareas pendientes [TODO][] y el archivo [CHANGELOG][].

## Copyright and License

The `phpcfdi/sat-estado-retenciones` library is copyright © [PhpCfdi](https://www.phpcfdi.com/)
and licensed for use under the MIT License (MIT). Please see [LICENSE][] for more information.

[contributing]: https://github.com/phpcfdi/sat-estado-retenciones/blob/main/CONTRIBUTING.md
[changelog]: https://github.com/phpcfdi/sat-estado-retenciones/blob/main/docs/CHANGELOG.md
[todo]: https://github.com/phpcfdi/sat-estado-retenciones/blob/main/docs/TODO.md

[source]: https://github.com/phpcfdi/sat-estado-retenciones
[release]: https://github.com/phpcfdi/sat-estado-retenciones/releases
[license]: https://github.com/phpcfdi/sat-estado-retenciones/blob/main/LICENSE
[build]: https://github.com/phpcfdi/sat-estado-retenciones/actions/workflows/build.yml?query=branch:main
[quality]: https://scrutinizer-ci.com/g/phpcfdi/sat-estado-retenciones/
[coverage]: https://scrutinizer-ci.com/g/phpcfdi/sat-estado-retenciones/code-structure/main/code-coverage/src
[downloads]: https://packagist.org/packages/phpcfdi/sat-estado-retenciones

[badge-source]: http://img.shields.io/badge/source-phpcfdi/sat-estado-retenciones-blue?style=flat-square
[badge-release]: https://img.shields.io/github/release/phpcfdi/sat-estado-retenciones?style=flat-square
[badge-license]: https://img.shields.io/github/license/phpcfdi/sat-estado-retenciones?style=flat-square
[badge-build]: https://img.shields.io/github/workflow/status/phpcfdi/sat-estado-retenciones/build/main?style=flat-square
[badge-quality]: https://img.shields.io/scrutinizer/g/phpcfdi/sat-estado-retenciones/main?style=flat-square
[badge-coverage]: https://img.shields.io/scrutinizer/coverage/g/phpcfdi/sat-estado-retenciones/main?style=flat-square
[badge-downloads]: https://img.shields.io/packagist/dt/phpcfdi/sat-estado-retenciones?style=flat-square
