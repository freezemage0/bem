<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Exception;


use Exception;


class AssetNotFoundException extends Exception implements CompilerException {
    public static function create(string $assetPath, string $assetName): AssetNotFoundException {
        return new AssetNotFoundException(sprintf(
                'Asset "%s" not found in "%s"',
                $assetName,
                $assetPath
        ));
    }
}