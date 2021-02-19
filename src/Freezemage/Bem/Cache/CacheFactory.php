<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Cache;


interface CacheFactory {
    public function getGenerator(): CacheGenerator;

    public function getValidator(): CacheValidator;
}