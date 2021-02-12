<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Node;


interface Node {
    public function hasParent(): bool;

    public function getParent(): ?Node;

    public function setParent(Node $node): void;

    public function getTag(): string;

    public function getName(): string;

    public function setContent(string $content): void;

    public function getContent(): string;

    public function hasContent(): bool;
}