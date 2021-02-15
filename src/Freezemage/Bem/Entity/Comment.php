<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Entity;


class Comment {
    protected string $authorName;
    protected string $message;

    /**
     * Comment constructor.
     * @param string $authorName
     * @param string $message
     */
    public function __construct(string $authorName, string $message) {
        $this->authorName = $authorName;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getAuthorName(): string {
        return $this->authorName;
    }

    /**
     * @return string
     */
    public function getMessage(): string {
        return $this->message;
    }
}