<?php

namespace Zapuskator;

use Noodlehaus\Config;

class Zapuskator
{

    public function start(string $configPath)
    {
        $config = new Config($configPath);
        $this->process($config->get('strategy', []));
    }

    protected function process(array $command, $state = null, array $stacktrace = []): void
    {
        foreach ($command as $item) {
            $method = $item['method'];
            if (!class_exists($method)) {
                throw new ProcessNotImplemented($method);
            }

            $process = new $method;
            if (!$process instanceof ProcessInterface) {
                throw new ProcessNotImplemented($method);
            }

            $process->setParameters($item['params'] ?? []);
            $process->setState($state);
            $process->setStacktrace($stacktrace);
            $state = $process->execute();

            if (array_key_exists('strategy', $item)) {
                $this->process($item['strategy'], $state, array_merge($stacktrace, [$process]));
            }
        }
    }

}
