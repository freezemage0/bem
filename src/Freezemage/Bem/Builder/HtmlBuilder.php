<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Builder;


use Freezemage\Bem\Node\Block;
use Freezemage\Bem\Node\Element;
use Freezemage\Bem\Node\ModifiableNode;
use Freezemage\Bem\Node\Modifier;
use Freezemage\Bem\Node\Node;
use InvalidArgumentException;
use LogicException;


class HtmlBuilder implements NodeBuilder {
    protected ClassNameBuilder $classNameBuilder;
    protected int $indentation;

    /**
     * HtmlBuilder constructor.
     * @param ClassNameBuilder $classNameBuilder
     */
    public function __construct(ClassNameBuilder $classNameBuilder) {
        $this->classNameBuilder = $classNameBuilder;
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
            throw new LogicException('пися жопа нихуя не работает!!!');
        }

        return $openTag . $content . $closeTag;
    }

    protected function openTag(Node $node): string {
        $tag = sprintf(
                '%s<%s class="%s">%s',
                $this->indent(),
                $node->getTag(),
                $this->buildTagClassName($node),
                PHP_EOL
        );

        $this->indentation += 1;
        return $tag;
    }

    protected function closeTag(Node $node): string {
        $this->indentation -= 1;
        return sprintf('%s</%s>', PHP_EOL . $this->indent(), $node->getTag());
    }

    protected function buildTagClassName(Node $node) {
        if ($node instanceof Modifier) {
            throw new InvalidArgumentException('Убери гавно свое анхуй');
        }

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

    protected function indent(): string {
        return str_repeat("\t", $this->indentation);
    }
}