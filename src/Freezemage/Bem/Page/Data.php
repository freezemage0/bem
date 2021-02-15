<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Page;


class Data {
    protected array $items;

    public function __construct() {
        $this->items = array();
    }

    public function get(string $key, $defaultValue = null) {
        return $this->items[$key] ?? $defaultValue;
    }

    public function has(string $key): bool {
        return isset($this->items[$key]);
    }

    public function set(string $key, $value): void {
        $this->items[$key] = $value;
    }
}