<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Node;


interface ModifiableNode extends Node {
    public function attachModifier(Modifier $modifier): self;

    public function getModifiers(): NodeCollection;
}