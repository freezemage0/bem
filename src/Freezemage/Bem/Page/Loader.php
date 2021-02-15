<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Page;


use Freezemage\Bem\Compiler;
use Freezemage\Bem\Config;


class Loader {
    protected Config $config;
    protected Compiler $compiler;

    public function __construct(Config $config, Compiler $compiler) {
        $this->config = $config;
        $this->compiler = $compiler;
    }

    public function load(string $page) {
        $pagePath = $this->config->getAssetPath() . '/' . ltrim($page, '/');

        if (is_file($pagePath)) {
            /** @noinspection PhpIncludeInspection */
            include $pagePath;
        }
    }
}