<?php

/*
 * Copyright CloseToMe 2011/2012
 */

namespace Socloz\StateBundle\Storage;

/**
 * Description of StorageInterface
 *
 * @author jfb
 */
interface StorageInterface
{

    /**
     * returns a value or create it if it doesn't exist
     * 
     * @param string $key
     * @param string $value
     * @param int $ttl
     * @return boolean
     */
    public function getOrCreate($key, $value, $ttl = null);
    
    /**
     * Deletes a value if and only if it equals to a certain value
     * 
     * @param string $key
     * @param string $value
     */
    public function deleteIfEquals($key, $value);
    
}
