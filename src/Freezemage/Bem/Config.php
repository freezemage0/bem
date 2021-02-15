<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem;

class Config {
    protected string $assetPath;
    protected string $outputPath;
    protected string $indentationCharacter;

    public function __construct(
            string $assetPath,
            string $outputPath,
            string $indentationCharacter
    ) {
        $this->assetPath = $assetPath;
        $this->indentationCharacter = $indentationCharacter;
        $this->outputPath = $outputPath;
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
}