<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Node;


interface ModifiableNode extends Node {
    public function attachModifier(Modifier $modifier): self;

    public function getModifiers(): NodeCollection;
}