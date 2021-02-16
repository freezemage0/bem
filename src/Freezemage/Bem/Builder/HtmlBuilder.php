<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Builder;


use Freezemage\Bem\Config;
use Freezemage\Bem\Node\AttributableNode;
use Freezemage\Bem\Node\Block;
use Freezemage\Bem\Node\Element;
use Freezemage\Bem\Node\ModifiableNode;
use Freezemage\Bem\Node\Node;
use LogicException;


class HtmlBuilder implements NodeBuilder {
    protected ClassNameBuilder $classNameBuilder;
    protected Config $config;
    protected int $indentation;

    /**
     * HtmlBuilder constructor.
     * @param ClassNameBuilder $classNameBuilder
     * @param Config $config
     */
    public function __construct(ClassNameBuilder $classNameBuilder, Config $config) {
        $this->classNameBuilder = $classNameBuilder;
        $this->config = $config;
        $this->indentation = 0;
    }

    public function build(Node $node): string {
        $openTag = $this->openTag($node);

        if ($node instanceof Block) {
            $children = array_merge(
                    $node->getBlocks()->toArray(),
                    $node->getElements()->toArray(),
            );

            $content = array();
            foreach ($children as $child) {
                $content[] = $this->build($child);
            }

            $content = implode(PHP_EOL, $content);
        }

        if ($node instanceof Element) {
            $children = $node->getElements()->toArray();

            $content = array();
            foreach ($children as $child) {
                $content[] = $this->build($child);
            }

            if ($node->hasContent()) {
                $content[] = $this->indent() . $node->getContent();
            }

            $content = implode(PHP_EOL, $content);
        }

        $closeTag = $this->closeTag($node);

        if (!isset($content)) {
            throw new LogicException('Unable to build html node.');
        }

        return $openTag . $content . $closeTag;
    }

    protected function openTag(Node $node): string {
        $template = $node->hasName() ? '%s<%s class="%s"' : '%s<%s';

        $tag = sprintf(
                $template,
                $this->indent(),
                $node->getTag(),
                $this->buildTagClassName($node),
        );

        if ($node instanceof AttributableNode) {
            $attributes = $this->buildAttributes($node);
            $tag .= !empty($attributes) ? ' ' . $attributes : '';
        }

        if (!$node->isEnclosed()) {
            $tag .= '>' . PHP_EOL;
        }

        $this->indentation += 1;
        return $tag;
    }

    protected function closeTag(Node $node): string {
        $this->indentation -= 1;
        return $node->isEnclosed() ? '/>' : sprintf('%s</%s>', PHP_EOL . $this->indent(), $node->getTag());
    }

    protected function buildTagClassName(Node $node) {
        $tagClassName = $this->classNameBuilder->build($node);

        if (!($node instanceof ModifiableNode)) {
            return $tagClassName;
        }

        $modifiers = $node->getModifiers()->toArray();
        foreach ($modifiers as $modifier) {
            $tagClassName .= ' ' . $this->classNameBuilder->build($modifier);
        }

        return $tagClassName;
    }

    protected function buildAttributes(AttributableNode $node): string {
        $attributes = $node->getAttributes()->toArray();

        $result = array();
        foreach ($attributes as $attribute) {
            $result[] = sprintf('%s="%s"', $attribute->getName(), $attribute->getValue());
        }

        return implode(' ', $result);
    }

    protected function indent(): string {
        return str_repeat($this->config->getIndentationCharacter(), $this->indentation);
    }
}