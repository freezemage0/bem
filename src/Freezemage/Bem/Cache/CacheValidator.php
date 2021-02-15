<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Cache;


use Freezemage\Bem\Node\Node;


class CacheValidator {
    public function validate(): bool {

    }

    protected function getHash(string $filePath): string {
        return md5_file($filePath);
    }
}