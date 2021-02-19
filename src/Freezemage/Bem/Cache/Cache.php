<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Cache;


use Freezemage\Bem\Node\Attribute;
use Freezemage\Bem\Node\Element;


class Cache {
    protected string $cachePath;

    public function __construct(string $cachePath) {
        $this->cachePath = $cachePath;
    }

    public function getCssElement(): Element {
        $css = new Element('link');
        $css->attachAttribute(new Attribute('rel', 'stylesheet'));
        $css->attachAttribute(new Attribute('href', $this->cachePath . '.css'));
        $css->enclose();

        return $css;
    }

    public function getJsElement(): Element {
        $js = new Element('script');
        $js->attachAttribute(new Attribute('src', $this->cachePath . '.js'));

        return $js;
    }
}