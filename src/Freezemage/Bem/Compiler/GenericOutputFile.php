<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Compiler;

abstract class GenericOutputFile implements OutputFile {
    protected string $format;
    protected string $path;
    protected string $content;

    public function __construct(string $format, string $path, string $content) {
        $this->format = $format;
        $this->path = $path;
        $this->content = $content;
    }

    public function getFormat(): string {
        return $this->format;
    }

    public function getPath(): string {
        return $this->path;
    }

    public function getContent(): string {
        return $this->content;
    }
}