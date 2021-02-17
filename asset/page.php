<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */
/** @var Loader $this */

use Freezemage\Bem\Page\Loader;
use Freezemage\Bem\Snippet\HeaderSnippet;


if (!($this instanceof Loader)) {
    return;
}

$header = new HeaderSnippet('Page!');
$this->compiler->body()->attachBlock($header->create());
