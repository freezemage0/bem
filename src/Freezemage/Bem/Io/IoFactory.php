<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Io;


interface IoFactory {
    public function createReader(): Reader;

    public function createWriter(): Writer;
}