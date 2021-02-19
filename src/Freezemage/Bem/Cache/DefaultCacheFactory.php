<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Cache;


use Freezemage\Bem\Config;
use Freezemage\Bem\Io\IoFactory;


class DefaultCacheFactory implements CacheFactory {
    protected IoFactory $ioFactory;
    protected Config $config;

    public function __construct(IoFactory $ioFactory, Config $config) {
        $this->ioFactory = $ioFactory;
        $this->config = $config;
    }

    public function getGenerator(): CacheGenerator {
        return new CacheGenerator($this->ioFactory, $this->config);
    }

    public function getValidator(): CacheValidator {
        return new CacheValidator($this->ioFactory, $this->config);
    }
}