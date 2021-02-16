<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Builder;


use Freezemage\Bem\Config;


class DefaultBuilderFactory implements BuilderFactory {
    protected Config $config;

    public function __construct(Config $config) {
        $this->config = $config;
    }

    public function getClassNameBuilder(): ClassNameBuilder {
        return new ClassNameBuilder();
    }

    public function getHtmlBuilder(): HtmlBuilder {
        return new HtmlBuilder($this->getClassNameBuilder(), $this->config);
    }

    public function getCssBuilder(): CssBuilder {
        return new CssBuilder($this->getClassNameBuilder());
    }

    public function getFilePathBuilder(): FilePathBuilder {
        return new FilePathBuilder();
    }

    public function getJsBuilder(): JsBuilder {
        return new JsBuilder();
    }
}