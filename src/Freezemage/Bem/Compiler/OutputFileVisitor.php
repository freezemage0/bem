<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Compiler;


interface OutputFileVisitor {
    public function processCss(CssOutputFile $cssOutputFile): void;

    public function processJs(JsOutputFile $jsOutputFile): void;
}