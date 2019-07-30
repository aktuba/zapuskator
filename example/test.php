<?php

require __DIR__ . '/../vendor/autoload.php';

use Zapuskator\ProcessInterface;
use Zapuskator\Zapuskator;

class Base implements ProcessInterface
{

    protected $params = [];

    protected $state = null;

    protected $stacktrace = [];

    public function setParameters(array $parameters)
    {
        $this->params = $parameters;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function setStacktrace(array $stacktrace)
    {
        $this->stacktrace = $stacktrace;
    }

    public function execute()
    {
        $stacktraceLevel = count($this->stacktrace);
        echo get_called_class() . PHP_EOL . "\tstate: " . print_r($this->state,
                true) . "\n\tlevel: {$stacktraceLevel}\n";
        return get_called_class() . '!';
    }

}

class User extends Base
{
}

class Comment extends Base
{
}

class Like extends Base
{
}

class Finish extends Base
{
}

(new Zapuskator)
    ->start(__DIR__ . '/config.yaml');
