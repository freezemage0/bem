<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Compiler;


interface OutputFileVisitor {
    public function processCss(CssOutputFile $cssOutputFile): void;

    public function processJs(JsOutputFile $jsOutputFile): void;
}