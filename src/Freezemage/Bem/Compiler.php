<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem;


use Freezemage\Bem\Builder\BuilderFactory;
use Freezemage\Bem\Cache\CacheGenerator;
use Freezemage\Bem\Cache\CacheValidator;
use Freezemage\Bem\Compiler\CodeGenerator;
use Freezemage\Bem\Compiler\Directory;
use Freezemage\Bem\Node\Attribute;
use Freezemage\Bem\Node\Block;
use Freezemage\Bem\Node\Node;
use Freezemage\Bem\Page\Structure;


class Compiler {
    protected Block $document;
    protected Block $head;
    protected Block $body;
    protected Config $config;
    protected BuilderFactory $builderFactory;
    protected CacheValidator $cacheValidator;
    protected CacheGenerator $cacheGenerator;
    protected CodeGenerator $codeGenerator;

    public function __construct(
            BuilderFactory $builderFactory,
            CacheValidator $cacheValidator,
            CacheGenerator $cacheGenerator,
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
        $this->cacheValidator = $cacheValidator;
        $this->cacheGenerator = $cacheGenerator;
        $this->codeGenerator = $codeGenerator;
    }

    public function head(): Block {
        return $this->head;
    }

    public function body(): Block {
        return $this->body;
    }

    public function compile(string $templateName) {
        $compiledNode = $this->compileNode($this->body);

        $structure = new Structure($templateName, $compiledNode);
        $this->createMissing($structure);

        if (!$this->cacheValidator->validate($structure)) {
            $this->cacheGenerator->generateCache($structure);
        }

        $cache = $this->cacheGenerator->read($templateName);
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
            $filePath = Directory::normalizeFilePath(
                    $this->builderFactory->getFilePathBuilder()->build($node),
                    $this->builderFactory->getClassNameBuilder()->build($node)
            );

            $nodes[$filePath] = array(
                    $this->config->getCssFormat() => $this->builderFactory->getCssBuilder()->build($node),
                    $this->config->getJsFormat() => $this->builderFactory->getJsBuilder()->build($node)
            );
        }

        return $nodes;
    }

    protected function createMissing(Structure $structure) {
        foreach ($structure->getPageCollection() as $file => $data) {
            foreach ($data as $type => $content) {
                $filePath = Directory::normalizeFilePath($this->config->getOutputPath(), $file . '.' . $type);
                if (!is_file($filePath)) {
                    $this->codeGenerator->createFile($filePath, $content);
                }
            }
        }
    }
}
