<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Builder;

use Freezemage\Bem\Node\Node;


class JsBuilder implements NodeBuilder {
    public function build(Node $node): string {
        return ';(function () {})();';
    }
}