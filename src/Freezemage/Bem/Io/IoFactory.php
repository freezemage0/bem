<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Io;


interface IoFactory {
    public function createReader(): Reader;

    public function createWriter(): Writer;
}