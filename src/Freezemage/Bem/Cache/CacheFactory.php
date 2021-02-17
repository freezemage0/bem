<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Cache;


interface CacheFactory {
    public function getGenerator(): CacheGenerator;

    public function getValidator(): CacheValidator;
}