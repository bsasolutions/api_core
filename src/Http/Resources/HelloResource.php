<?php

declare(strict_types=1);

namespace Bsa\Core\Http\Resources;

class HelloResource
{
    public static function hello(): string
    {
        return 'Hello Core';
    }
}
