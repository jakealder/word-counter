<?php

namespace App\HtmlParser;

use App\HtmlParser\Drivers\CustomDriver;
use App\HtmlParser\Drivers\PaquettgDriver;
use Illuminate\Support\Manager;

class HtmlParserManager extends Manager {

    /**
     * Get a driver instance.
     *
     * @param string|null $name
     * @return mixed
     */
    public function channel(string $name = null): mixed {
        return $this->driver($name);
    }

    /**
     * Create a Custom driver instance.
     *
     * @return CustomDriver;
     */
    public function createCustomDriver(): CustomDriver {
        return new CustomDriver();
    }

    /**
     * Create a Paquettg driver instance.
     *
     * @return PaquettgDriver;
     */
    public function createPaquettgDriver(): PaquettgDriver {
        return new PaquettgDriver();
    }

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver(): string {
        return 'custom' ?? 'null';
    }
}
