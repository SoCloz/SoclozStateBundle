<?php

/*
 * Copyright CloseToMe 2011/2012
 */

namespace Socloz\StateBundle\Services;

/**
 * Base class for all services
 *
 * @author jfb
 */
abstract class Base
{

    protected $storage;
    protected $prefix;
    
    /**
     * @param \Socloz\StateBundle\Storage\StorageInterface $storage
     * @param string $prefix
     */
    public function __construct($storage, $prefix)
    {
        $this->storage = $storage;
        $this->prefix = $prefix;
        $this->init();
    }
    
    /**
     * Initializes the service
     */
    protected function init()
    {
    }
    
    /**
     * Returns the service subnamespace
     */
    abstract protected function getServiceStoragePrefix();

    /**
     * Computes the storage key
     * 
     * @param string $key
     * @return string
     */
    protected function getStorageKey($key) {
        return $this->prefix.".".$this->getServiceStoragePrefix().".".$key;
    }
        
}
