<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Io;


interface Reader {
    public function open(string $input): self;

    public function read(int $length): string;

    public function toString(): string;
}