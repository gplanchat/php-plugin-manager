<?php

namespace Gplanchat\PluginManager;

interface PluginInterface
{
    /**
     * @param string $namespace
     * @param array $params
     * @return mixed
     */
    public function __invoke($namespace, array $params = []);

    /**
     * @param PluginManagerInterface $application
     * @return $this
     */
    public function register(PluginManagerInterface $application);
}
