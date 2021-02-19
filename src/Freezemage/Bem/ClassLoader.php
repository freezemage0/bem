<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem;


class ClassLoader {
    protected static string $documentRoot;

    public static function register(): void {
        spl_autoload_register(array(ClassLoader::class, 'autoLoad'));
    }

    public static function unregister(): void {
        spl_autoload_unregister(array(ClassLoader::class, 'autoLoad'));
    }

    public static function autoLoad(string $fqn): void {
        $fqn = str_replace('\\', DIRECTORY_SEPARATOR, ltrim($fqn, '\\'));
        $absolute = ClassLoader::getDocumentRoot() . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $fqn . '.php';

        if (is_file($absolute)) {
            /** @noinspection PhpIncludeInspection */
            include $absolute;
        }
    }

    public static function getDocumentRoot(): string {
        if (!isset(ClassLoader::$documentRoot)) {
            ClassLoader::$documentRoot = dirname(__DIR__, 3);
        }

        return ClassLoader::$documentRoot;
    }
}