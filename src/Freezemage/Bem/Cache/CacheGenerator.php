<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Cache;


use Freezemage\Bem\Compiler\CssOutputFile;
use Freezemage\Bem\Compiler\JsOutputFile;
use Freezemage\Bem\Compiler\OutputFile;
use Freezemage\Bem\Compiler\OutputFileVisitor;
use Freezemage\Bem\Config;
use Freezemage\Bem\Io\Directory;
use Freezemage\Bem\Io\IoFactory;
use Freezemage\Bem\Io\Writer;
use Freezemage\Bem\Page\Structure;


class CacheGenerator implements OutputFileVisitor {
    protected Config $config;
    protected IoFactory $io;
    protected Writer $jsWriter;
    protected Writer $cssWriter;
    protected array $cache;

    public function __construct(IoFactory $io, Config $config) {
        $this->config = $config;
        $this->io = $io;
    }

    public function generateCache(Structure $structure) {
        $this->cache = array();

        $cacheDir = new Directory($this->config->getCachePath());
        $templateDir = new Directory($cacheDir->normalizeFilePath($structure->getPageName()));

        if (!$templateDir->exists()) {
            $templateDir->create();
        }

        $filePath = $templateDir->normalizeFilePath('/main');

        $this->cssWriter = $this->io->createWriter()->open($filePath . '.' . $this->config->getCssFormat());
        $this->jsWriter = $this->io->createWriter()->open($filePath . '.' .$this->config->getJsFormat());

        foreach ($structure->getPageCollection() as $outputFile) {
            $outputFile->accept($this);
        }

        $cacheStream = $this->io->createWriter()->open($filePath . '.cache');
        $content = '<?php' . PHP_EOL . PHP_EOL . 'return ' . var_export($this->cache, true) . ';' . PHP_EOL;
        $cacheStream->write($content);
    }

    public function read(string $templateName): Cache {
        $cacheDir = new Directory($this->config->getCachePath());
        return new Cache($cacheDir->normalizeFilePath($templateName . '/main'));
    }

    protected function generateHash(string $content): string {
        return md5($content);
    }

    public function processCss(CssOutputFile $cssOutputFile): void {
        $this->cacheFile($this->cssWriter, $cssOutputFile);
    }

    public function processJs(JsOutputFile $jsOutputFile): void {
        $this->cacheFile($this->jsWriter, $jsOutputFile);
    }

    protected function cacheFile(Writer $writer, OutputFile $outputFile): void {
        $outputDir = new Directory($this->config->getOutputPath());
        $originalFile = $outputDir->normalizeFilePath($outputFile->getPath() . '.' . $outputFile->getFormat());
        $originalContent = $this->io->createReader()->open($originalFile)->toString();

        $writer->write($originalContent);
        $this->cache[$originalFile] = $this->generateHash($originalContent);
    }
}