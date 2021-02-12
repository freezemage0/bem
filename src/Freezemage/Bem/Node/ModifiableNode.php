<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Node;


interface ModifiableNode extends Node {
    public function attachModifier(Modifier $modifier): void;

    public function getModifiers(): NodeCollection;
}