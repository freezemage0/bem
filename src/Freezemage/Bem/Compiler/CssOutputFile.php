<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Compiler;


class CssOutputFile extends GenericOutputFile {
    public function accept(OutputFileVisitor $visitor): void {
        $visitor->processCss($this);
    }
}