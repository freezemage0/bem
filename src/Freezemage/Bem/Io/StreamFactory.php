<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Io;


class StreamFactory implements IoFactory {
    public function createReader(): Reader {
        return new StreamReader();
    }

    public function createWriter(): Writer {
        return new StreamWriter();
    }
}