<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Io;


use Freezemage\Bem\Exception\IoException;
use SplFileObject;


class StreamReader implements Reader {
    protected SplFileObject $stream;

    public function open(string $input): self {
        $this->stream = new SplFileObject($input, 'r');
        return $this;
    }

    public function read(int $length): string {
        if (!isset($this->stream)) {
            throw new IoException('Stream closed.');
        }

        return $this->stream->fread($length);
    }

    public function toString(): string {
        if (!isset($this->stream)) {
            throw new IoException('Stream closed.');
        }

        $content = '';

        $this->stream->rewind();
        while (!$this->stream->eof()) {
            $content .= $this->stream->fread(4096);
        }

        return $content;
    }
}