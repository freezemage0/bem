<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Node;


interface AttributableNode extends Node {
    public function attachAttribute(Attribute $attribute): void;

    public function getAttributes(): AttributeCollection;
}