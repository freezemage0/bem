<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Io;


class StreamFactory implements IoFactory {
    public function createReader(): Reader {
        return new StreamReader();
    }

    public function createWriter(): Writer {
        return new StreamWriter();
    }
}