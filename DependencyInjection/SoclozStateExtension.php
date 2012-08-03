<?php

/*
 * Copyright 2011 Johannes M. Schmitt <schmittjoh@gmail.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Socloz\StateBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * JMSSecurityExtraExtension.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class SoclozStateExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->process($configuration->getConfigTree(), $configs);

        if (isset($config['storage']['prefix'])) {
            $container->setParameter('socloz_state.storage.prefix', $config['storage']['prefix']);
        }
        if (isset($config['storage']['redis']['host'])) {
            $container->setParameter('socloz_state.storage.redis.host', $config['storage']['redis']['host']);
        }
        if (isset($config['storage']['redis']['port'])) {
            $container->setParameter('socloz_state.storage.redis.port', $config['storage']['redis']['port']);
        }
        
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}