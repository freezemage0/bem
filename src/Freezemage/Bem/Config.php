<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem;

class Config {
    protected string $assetPath;
    protected string $outputPath;
    protected string $indentationCharacter;
    protected string $jsFormat;
    protected string $cssFormat;

    public function __construct(
            string $assetPath,
            string $outputPath,
            string $indentationCharacter,
            string $jsFormat,
            string $cssFormat
    ) {
        $this->assetPath = $assetPath;
        $this->indentationCharacter = $indentationCharacter;
        $this->outputPath = $outputPath;
        $this->jsFormat = $jsFormat;
        $this->cssFormat = $cssFormat;
    }

    public function getAssetPath(): string {
        return $this->assetPath;
    }

    public function getOutputPath(): string {
        return $this->outputPath;
    }

    public function getIndentationCharacter(): string {
        return $this->indentationCharacter;
    }

    public function getJsFormat(): string {
        return $this->jsFormat;
    }

    public function getCssFormat(): string {
        return $this->cssFormat;
    }
}