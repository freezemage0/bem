<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Cache;


use Freezemage\Bem\Compiler\Directory;
use Freezemage\Bem\Compiler\StreamReader;
use Freezemage\Bem\Compiler\StreamWriter;
use Freezemage\Bem\Config;
use Freezemage\Bem\Page\Structure;


class CacheGenerator {
    protected Config $config;

    public function __construct(Config $config) {
        $this->config = $config;
    }

    public function generateCache(Structure $structure) {
        $filePath = $this->config->getOutputPath() . '/' . $structure->getPageName() . '/main';

        $jsStream = new StreamWriter($filePath . '.' . $this->config->getJsFormat());
        $cssStream = new StreamWriter($filePath . '.' . $this->config->getCssFormat());

        $cache = array();

        foreach ($structure->getPageCollection() as $node => $content) {
            foreach ($content as $type => $data) {
                $originalFile = Directory::normalizeFilePath($this->config->getOutputPath(), $node . '.' . $type);
                $reader = new StreamReader($originalFile);
                $data = $reader->toString();

                if ($type == $this->config->getJsFormat()) {
                    $jsStream->write($data);
                }

                if ($type == $this->config->getCssFormat()) {
                    $cssStream->write($data);
                }

                $cache[$originalFile] = $this->generateHash($data);
            }
        }

        $cacheStream = new StreamWriter($filePath . '.cache');
        $content = '<?php' . PHP_EOL . PHP_EOL . 'return ' . var_export($cache, true) . ';' . PHP_EOL;
        $cacheStream->write($content);
    }

    public function read(string $templateName): Cache {
        return new Cache(rtrim($this->config->getOutputPath(), '/') . '/' . $templateName . '/main');
    }

    protected function generateHash(string $content): string {
        return md5($content);
    }
}