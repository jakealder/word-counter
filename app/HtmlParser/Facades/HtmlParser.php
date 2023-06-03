<?php

namespace App\HtmlParser\Facades;

use Illuminate\Support\Facades\Facade;

class HtmlParser extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string {
        return 'htmlparser';
    }
}
