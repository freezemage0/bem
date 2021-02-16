<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Builder;


interface BuilderFactory {
    public function getClassNameBuilder(): ClassNameBuilder;

    public function getHtmlBuilder(): HtmlBuilder;

    public function getCssBuilder(): CssBuilder;

    public function getFilePathBuilder(): FilePathBuilder;

    public function getJsBuilder(): JsBuilder;
}