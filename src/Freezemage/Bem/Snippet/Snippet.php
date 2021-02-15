<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Snippet;

use Freezemage\Bem\Node\Block;


interface Snippet {
    public function create(): Block;
}