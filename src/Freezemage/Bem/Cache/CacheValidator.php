<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Cache;


use DirectoryIterator;
use Freezemage\Bem\Compiler\Directory;
use Freezemage\Bem\Compiler\StreamReader;
use Freezemage\Bem\Config;
use Freezemage\Bem\Node\Node;
use Freezemage\Bem\Page\Structure;


class CacheValidator {
    protected Config $config;

    /**
     * CacheValidator constructor.
     * @param Config $config
     */
    public function __construct(Config $config) {
        $this->config = $config;
    }

    public function validate(Structure $structure): bool {
        $cacheFile = Directory::normalizeFilePath(
                $this->config->getOutputPath(),
                $structure->getPageName() . '/main.cache'
        );

        if (!is_file($cacheFile)) {
            return false;
        }

        /** @noinspection PhpIncludeInspection */
        $cache = include $cacheFile;

        foreach ($structure->getPageAssets() as $file) {
            $filePath = Directory::normalizeFilePath($this->config->getOutputPath(), $file);
            $reader = new StreamReader($filePath);

            $hash = $this->getHash($reader->toString());
            if ($hash != $cache[$filePath]) {
                return false;
            }
        }
        return true;
    }

    protected function getHash(string $content): string {
        return md5($content);
    }
}