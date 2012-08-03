SoclozStateBundle
=================

A Symfony2 bundle to manage state, configuration, locks and features flags

Dependencies
------------

It currently uses Redis as a storage backend. phpredis needs to be installed.

Lock Manager
------------

Usage:

    $lockManager = $container->get('socloz_state.lock_manager');
    if ($lockManager->lock("lock_name") {
        // do some stuff
        $lockManager->unlock("lock_name");
    }

State manager
-------------

Not yet implemented

Feature flag manager
--------------------

Not yet implemented

