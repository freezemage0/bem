<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Io;


interface Writer {
    public function open(string $input): self;

    public function write(string $data): int;
}