<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Compiler;


use SplFileObject;


class StreamWriter implements Writer {
    protected SplFileObject $file;

    public function __construct(string $fileName) {
        $this->file = new SplFileObject($fileName, 'w');
    }

    public function write(string $data): void {
        $this->file->fwrite($data);
    }
}