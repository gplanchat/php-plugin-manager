<?php

namespace Gplanchat\PluginManager;

use SplPriorityQueue as PriorityQueue;

trait PluginManagerTrait
{
    private $pluginQueues = [];

    /**
     * @param PluginInterface $plugin
     * @param string $namespace
     * @param int|null $priority
     * @return $this
     */
    public function registerPlugin(PluginInterface $plugin, $namespace, $priority = null)
    {
        if (!isset($this->pluginQueues[$namespace])) {
            $this->pluginQueues[$namespace] = new PriorityQueue();
        }

        /** @var PriorityQueue $queue */
        $queue = $this->pluginQueues[$namespace];

        $queue->insert($plugin, $priority);
        $plugin->register($this);

        return $this;
    }

    /**
     * @param string $namespace
     * @param array $params
     * @return $this
     */
    public function callPlugin($namespace, array $params = [])
    {
        if (!isset($this->pluginQueues[$namespace])) {
            return $this;
        }

        foreach ($this->pluginQueues[$namespace] as $plugin) {
            $plugin($namespace, $params);
        }

        return $this;
    }

    /**
     * @param string $namespace
     * @return $this
     */
    public function clearPlugins($namespace)
    {
        unset($this->pluginQueues[$namespace]);
        return $this;
    }

    /**
     * @param string $namespace
     * @return PriorityQueue|null
     */
    public function getPlugins($namespace)
    {
        if (!isset($this->pluginQueues[$namespace])) {
            return null;
        }

        return $this->pluginQueues[$namespace];
    }
}
