<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Snippet;


use Freezemage\Bem\Node\Block;


interface Snippet {
    public function create(): Block;
}