<?php


namespace Freezemage\Bem\Compiler;


interface OutputFile {
    public function getFormat(): string;

    public function getContent(): string;

    public function getPath(): string;

    public function accept(OutputFileVisitor $visitor): void;
}