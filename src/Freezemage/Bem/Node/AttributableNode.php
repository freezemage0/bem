<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Node;


interface AttributableNode extends Node {
    public function attachAttribute(Attribute $attribute): void;

    public function getAttributes(): AttributeCollection;
}