<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Page;


use Freezemage\Bem\Compiler;
use Freezemage\Bem\Exception\AssetNotFoundException;
use Freezemage\Bem\Io\Directory;
use Freezemage\Bem\Config;


class Loader {
    protected Config $config;
    protected Compiler $compiler;

    public function __construct(Config $config, Compiler $compiler) {
        $this->config = $config;
        $this->compiler = $compiler;
    }

    public function load(string $page) {
        $pageDirPath = new Directory($this->config->getAssetPath());
        $pageFilePath = $pageDirPath->normalizeFilePath($page . '.php');

        if (!is_file($pageFilePath)) {
            throw AssetNotFoundException::create($this->config->getAssetPath(), $pageFilePath);
        }

        /** @noinspection PhpIncludeInspection */
        include $pageFilePath;

        return $this->compiler->compile($page);
    }
}