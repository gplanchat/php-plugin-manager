<?php

namespace Gplanchat\PluginManager;

interface PluginManagerInterface
{
    /**
     * @param PluginInterface $plugin
     * @param string $namespace
     * @param int|null $priority
     * @return PluginManagerInterface
     */
    public function registerPlugin(PluginInterface $plugin, $namespace, $priority = null);

    /**
     * @param string $namespace
     * @param array $params
     * @return mixed
     */
    public function callPlugin($namespace, array $params);

    /**
     * @param string $namespace
     * @return PluginManagerInterface
     */
    public function clearPlugins($namespace);

    /**
     * @param string $namespace
     * @return PluginManagerInterface
     */
    public function getPlugins($namespace);
}
