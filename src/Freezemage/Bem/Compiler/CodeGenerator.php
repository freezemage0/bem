<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Compiler;


use Freezemage\Bem\Config;


class CodeGenerator {
    protected Config $config;

    public function __construct(Config $config) {
        $this->config = $config;
    }

    public function createFile(string $fileName, string $content) {
        Directory::create(dirname($fileName));

        $stream = new StreamWriter($fileName);
        $stream->write($content);
    }
}