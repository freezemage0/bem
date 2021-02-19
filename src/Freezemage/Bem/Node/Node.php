<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Node;


interface Node {
    public function hasParent(): bool;

    public function getParent(): ?Node;

    public function setParent(Node $node): void;

    public function hasChildren(): bool;

    public function getChildren(): NodeCollection;

    public function getTag(): string;

    public function getName(): ?string;

    public function hasName(): bool;

    public function setContent(string $content): void;

    public function getContent(): string;

    public function hasContent(): bool;

    public function enclose(): void;

    public function isEnclosed(): bool;
}