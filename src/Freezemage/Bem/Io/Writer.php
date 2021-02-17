<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Io;


interface Writer {
    public function open(string $input): self;

    public function write(string $data): int;
}