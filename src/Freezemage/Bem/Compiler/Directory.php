<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Compiler;

class Directory {
    public static function create(string $path): void {
        if (!Directory::exists($path)) {
            mkdir($path, 0777, true);
        }
    }

    public static function exists(string $path): bool {
        return is_dir($path);
    }

    public static function delete(string $path): void {
        if (Directory::exists($path)) {
            rmdir($path);
        }
    }

    public static function normalizeFilePath(string $directory, string $file) {
        return rtrim($directory, '/') . '/' . ltrim($file, '/');
    }
}