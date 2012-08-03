<?php

/*
 * Copyright CloseToMe 2011/2012
 */

namespace Socloz\StateBundle\Services;

/**
 * LockManager
 *
 * @author jfb
 */
class LockManager extends Base
{

    protected $pid;
    
    public function init()
    {
        $this->pid = getmypid();
    }
    
    protected function getServiceStoragePrefix()
    {
        return "lock";
    }
    
    /**
     * Acquires lock
     * 
     * @param string $key
     * @param string $lockValue
     * @param int $timeout - lock acquisition timeout (not used)
     * @param int $ttl - lock ttl
     * @return boolean
     */
    public function lock($key, $lockValue = null, $timeout = null, $ttl = null)
    {
        $lockValue = $lockValue === null ? $this->pid : $lockValue;
        $currentLockValue = $this->storage->getOrCreate($this->getStorageKey($key), $lockValue, $ttl);
        return ($currentLockValue == $lockValue);
    }
    
    /**
     * Releases lock
     * 
     * @param string $key
     * @param string $lockValue
     * @return boolean
     */
    public function unlock($key, $lockValue = null)
    {
        $lockValue = $lockValue === null ? $this->pid : $lockValue;
        return $this->storage->deleteIfEquals($this->getStorageKey($key), $lockValue);
    }
    
    /**
     * Tests lock
     * 
     * @param string $key
     * @param string $lockValue
     * @return boolean
     */
    public function isLocked($key, $lockValue = null)
    {
        $lockValue = $lockValue === null ? $this->pid : $lockValue;
        $currentLockValue = $this->storage->get($this->getStorageKey($key));
        return ($currentLockValue != $lockValue);
    }

}
