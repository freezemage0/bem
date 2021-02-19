<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem;

class Config {
    protected string $assetPath;
    protected string $outputPath;
    protected string $indentationCharacter;
    protected string $jsFormat;
    protected string $cssFormat;
    protected string $cachePath;

    public function __construct(
            string $assetPath,
            string $outputPath,
            string $cachePath,
            string $indentationCharacter,
            string $jsFormat,
            string $cssFormat
    ) {
        $this->assetPath = $assetPath;
        $this->outputPath = $outputPath;
        $this->cachePath = $cachePath;
        $this->indentationCharacter = $indentationCharacter;
        $this->jsFormat = $jsFormat;
        $this->cssFormat = $cssFormat;
    }

    public function getAssetPath(): string {
        return $this->assetPath;
    }

    public function getOutputPath(): string {
        return $this->outputPath;
    }

    public function getCachePath(): string {
        return $this->cachePath;
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