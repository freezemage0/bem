<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Compiler;


use SplFileObject;


class StreamReader implements Reader {
    protected SplFileObject $file;

    public function __construct(string $fileName) {
        $this->file = new SplFileObject($fileName, 'r');
    }

    public function read(?int $size = null): string {
        return $this->file->fread($size ?? 4096);
    }

    public function toString(): string {
        $content = '';

        while (!$this->file->eof()) {
            $content .= $this->read();
        }

        return $content;
    }
}