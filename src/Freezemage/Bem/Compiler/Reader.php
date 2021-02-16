<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Compiler;


interface Reader {
    public function read(): string;
}