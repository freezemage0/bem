<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Io;

use Freezemage\Bem\Exception\IoException;
use SplFileObject;


class StreamWriter implements Writer {
    protected SplFileObject $stream;

    public function open(string $input): self {
        $this->stream = new SplFileObject($input, 'w');
        return $this;
    }

    public function write(string $data): int {
        if (!isset($this->stream)) {
            throw new IoException('Stream closed.');
        }

        return $this->stream->fwrite($data);
    }
}