<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Compiler;


interface Writer {
    public function write(string $data): void;
}