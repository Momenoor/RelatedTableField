<?php

namespace Momenoor\RelatedTableField\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Momenoor\RelatedTableField\RelatedTableField
 */
class RelatedTableField extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Momenoor\RelatedTableField\RelatedTableField::class;
    }
}
