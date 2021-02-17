<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Compiler;

class JsOutputFile extends GenericOutputFile {
    public function accept(OutputFileVisitor $visitor): void {
        $visitor->processJs($this);
    }
}