<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Compiler;


class CssOutputFile extends GenericOutputFile {
    public function accept(OutputFileVisitor $visitor): void {
        $visitor->processCss($this);
    }
}