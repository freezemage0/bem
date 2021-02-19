<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Page;


use Freezemage\Bem\Compiler\Directory;
use Freezemage\Bem\Compiler\OutputFile;


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
     * @return OutputFile[]
     */
    public function getPageCollection(): array {
        return $this->pageCollection;
    }
}