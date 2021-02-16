<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Page;


use Freezemage\Bem\Compiler\Directory;


class Structure {
    protected string $pageName;
    protected array $pageCollection;

    /**
     * Structure constructor.
     * @param string $pageName
     * @param array $pageCollection
     */
    public function __construct(string $pageName, array $pageCollection) {
        $this->pageName = $pageName;
        $this->pageCollection = $pageCollection;
    }

    /**
     * @return string
     */
    public function getPageName(): string {
        return $this->pageName;
    }

    /**
     * @return array
     */
    public function getPageCollection(): array {
        return $this->pageCollection;
    }

    public function getPageAssets(): array {
        $assets = array();

        foreach ($this->pageCollection as $file => $data) {
            foreach ($data as $type => $content) {
                $assets[] = $file . '.' . $type;
            }
        }

        return $assets;
    }

    public function iterate(callable $callback): void {
        foreach ($this->pageCollection as $file => $data) {
            foreach ($data as $type => $content) {
                call_user_func($callback, $file, $type, $content);
            }
        }
    }
}