<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem;


use Freezemage\Bem\Builder\BuilderFactory;
use Freezemage\Bem\Builder\DefaultBuilderFactory;
use Freezemage\Bem\Cache\CacheFactory;
use Freezemage\Bem\Cache\DefaultCacheFactory;
use Freezemage\Bem\Compiler\CodeGenerator;
use Freezemage\Bem\Compiler\CssOutputFile;
use Freezemage\Bem\Compiler\JsOutputFile;
use Freezemage\Bem\Io\IoFactory;
use Freezemage\Bem\Io\StreamFactory;
use Freezemage\Bem\Node\Attribute;
use Freezemage\Bem\Node\Block;
use Freezemage\Bem\Node\Element;
use Freezemage\Bem\Node\Node;
use Freezemage\Bem\Page\Structure;


class Compiler {
    protected Block $document;
    protected Block $head;
    protected Block $body;
    protected Config $config;
    protected BuilderFactory $builderFactory;
    protected IoFactory $ioFactory;
    protected CacheFactory $cacheFactory;
    protected CodeGenerator $codeGenerator;

    public static function fromConfig(Config $config): Compiler {
        $ioFactory = new StreamFactory();
        $builderFactory = new DefaultBuilderFactory($config);
        $cacheFactory = new DefaultCacheFactory($ioFactory, $config);
        $codeGenerator = new CodeGenerator($ioFactory, $config);

        return new Compiler($builderFactory, $ioFactory, $cacheFactory, $codeGenerator, $config);
    }

    public function __construct(
            BuilderFactory $builderFactory,
            IoFactory $ioFactory,
            CacheFactory $cacheFactory,
            CodeGenerator $codeGenerator,
            Config $config
    ) {
        $this->config = $config;

        $this->document = new Block('html');
        $this->document->attachAttribute(new Attribute('lang', 'en'));

        $this->head = new Block('head');
        $this->body = new Block('body');

        $this->document->attachBlock($this->head);
        $this->document->attachBlock($this->body);

        $this->builderFactory = $builderFactory;
        $this->ioFactory = $ioFactory;
        $this->cacheFactory = $cacheFactory;
        $this->codeGenerator = $codeGenerator;
    }

    public function head(): Block {
        return $this->head;
    }

    public function body(): Block {
        return $this->body;
    }

    public function css(string $path): self {
        $css = new Element('link');
        $css->attachAttribute(new Attribute('rel', 'stylesheet'));
        $css->attachAttribute(new Attribute('href', $path));
        $css->enclose();

        $this->head()->attachElement($css);

        return $this;
    }

    public function js(string $path): self {
        $js = new Element('script');
        $js->attachAttribute(new Attribute('src', $path));

        $this->body()->attachElement($js);

        return $this;
    }

    public function compile(string $templateName) {
        $compiledNode = $this->compileNode($this->body);

        $structure = new Structure($templateName, $compiledNode);
        $this->codeGenerator->createMissing($structure);

        if (!$this->cacheFactory->getValidator()->validate($structure)) {
            $this->cacheFactory->getGenerator()->generateCache($structure);
        }

        $cache = $this->cacheFactory->getGenerator()->read($templateName);
        $this->head()->attachElement($cache->getCssElement());
        $this->body()->attachElement($cache->getJsElement());

        return $this->builderFactory->getHtmlBuilder()->build($this->document);
    }

    protected function compileNode(Node $node): array {
        $nodes = array();

        if ($node->hasChildren()) {
            foreach ($node->getChildren()->toArray() as $child) {
                $nodes = array_merge($nodes, $this->compileNode($child));
            }
        }

        if ($node !== $this->body) {
            $directory = new Io\Directory($this->builderFactory->getFilePathBuilder()->build($node));
            $filePath = $directory->normalizeFilePath($this->builderFactory->getClassNameBuilder()->build($node));

            $cssBuilder = $this->builderFactory->getCssBuilder();
            $jsBuilder = $this->builderFactory->getJsBuilder();

            $nodes[] = new CssOutputFile($this->config->getCssFormat(), $filePath, $cssBuilder->build($node));
            $nodes[] = new JsOutputFile($this->config->getJsFormat(), $filePath, $jsBuilder->build($node));
        }

        return $nodes;
    }
}
