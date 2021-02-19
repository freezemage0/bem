<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Cache;


use Freezemage\Bem\Config;
use Freezemage\Bem\Io\Directory;
use Freezemage\Bem\Io\IoFactory;
use Freezemage\Bem\Page\Structure;


class CacheValidator {
    protected Config $config;
    protected IoFactory $io;

    /**
     * CacheValidator constructor.
     * @param IoFactory $io
     * @param Config $config
     */
    public function __construct(IoFactory $io, Config $config) {
        $this->io = $io;
        $this->config = $config;
    }

    public function validate(Structure $structure): bool {
        $outputDir = new Directory($this->config->getOutputPath());
        $cacheDir = new Directory($this->config->getCachePath());

        $cacheFile = $cacheDir->normalizeFilePath($structure->getPageName() . '/main.cache');

        if (!is_file($cacheFile)) {
            return false;
        }

        /** @noinspection PhpIncludeInspection */
        $cache = include $cacheFile;

        foreach ($structure->getPageCollection() as $file) {
            $filePath = $outputDir->normalizeFilePath($file->getPath() . '.' . $file->getFormat());
            $reader = $this->io->createReader()->open($filePath);

            $hash = $this->getHash($reader->toString());
            if (!isset($cache[$filePath]) || $hash != $cache[$filePath]) {
                return false;
            }
        }
        return true;
    }

    protected function getHash(string $content): string {
        return md5($content);
    }
}