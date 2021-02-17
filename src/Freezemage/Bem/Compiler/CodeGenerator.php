<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Compiler;


use Freezemage\Bem\Config;
use Freezemage\Bem\Io\IoFactory;
use Freezemage\Bem\Page\Structure;


class CodeGenerator implements OutputFileVisitor {
    protected IoFactory $io;
    protected Config $config;

    public function __construct(IoFactory $io, Config $config) {
        $this->io = $io;
        $this->config = $config;
    }

    public function createFile(string $fileName, string $content) {
        $directory = new \Freezemage\Bem\Io\Directory(dirname($fileName));
        if (!$directory->exists()) {
            $directory->create();
        }

        $file = $this->io->createWriter()->open($directory->normalizeFilePath(basename($fileName))); // сам написал, сам хакнул
        $file->write($content);
    }

    public function createMissing(Structure $structure) {
        foreach ($structure->getPageCollection() as $outputFile) {
            $outputFile->accept($this);
        }
    }

    public function processCss(CssOutputFile $cssOutputFile): void {
        $this->processFile($cssOutputFile);
    }

    public function processJs(JsOutputFile $jsOutputFile): void {
        $this->processFile($jsOutputFile);
    }

    protected function processFile(OutputFile $outputFile) {
        $outputDir = new \Freezemage\Bem\Io\Directory($this->config->getOutputPath());

        $file = $outputDir->normalizeFilePath($outputFile->getPath() . '.' . $outputFile->getFormat());
        if (!is_file($file)) {
            $this->createFile($file, $outputFile->getContent());
        }
    }
}