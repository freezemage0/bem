<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Builder;

use Freezemage\Bem\Node\Node;


class JsBuilder implements NodeBuilder {
    public function build(Node $node): string {
        return ';(function () {})();';
    }
}