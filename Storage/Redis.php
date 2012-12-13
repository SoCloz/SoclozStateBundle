<?php

/*
 * Copyright CloseToMe 2011/2012
 */

namespace Socloz\StateBundle\Storage;

/**
 * Description of newPHPClass
 *
 * @author jfb
 */
class Redis implements StorageInterface
{

    protected $redis;
    
    public function __construct($host, $port)
    {
        $this->redis = new \Redis();
        $this->redis->pconnect($host, $port);
    }
    public function getOrCreate($key, $value, $ttl = null)
    {
        $multi = $this->redis->multi()
                ->setnx($key, $value);
        // memory full ?
        if ($multi == null) {
            return null;
        }
        if ($ttl) {
            $multi->expire($key, $ttl);
        }
        $ret = $multi->get($key)
                ->exec();
        return array_pop($ret);
    }
    
    public function deleteIfEquals($key, $value)
    {
        // FIXME
        $this->redis->delete($key);
    }
}
