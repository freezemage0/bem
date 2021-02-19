<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Compiler;

class JsOutputFile extends GenericOutputFile {
    public function accept(OutputFileVisitor $visitor): void {
        $visitor->processJs($this);
    }
}