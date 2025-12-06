<?php

namespace Modules\Dfe\app\Enums;

enum NfeActions: string
{
    case EMIT = 'emit';
    case CONSULT = 'consult';
    case CANCEL = 'cancel';
    case CCE = 'cce';
    case INUTILIZE = 'inutilize';
    case GET_XML = 'get_xml';
    case GET_PDF = 'get_pdf';

    public static function isValid(string $value): bool
    {
        return collect(self::cases())->contains(fn($c) => $c->value === $value);
    }
}
