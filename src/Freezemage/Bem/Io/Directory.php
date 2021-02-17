<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Io;


class Directory {
    protected string $path;

    public function __construct(string $path) {
        $this->path = $path;
    }

    public function exists(): bool {
        return is_dir($this->path);
    }

    public function create(): void {
        mkdir($this->path, 0777, true);
    }

    public function delete(): void {
        rmdir($this->path);
    }

    public function normalizeFilePath(string $path) {
        return rtrim($this->path, '/') . '/' . rtrim($path, '/');
    }
}