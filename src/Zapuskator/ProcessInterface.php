<?php

namespace Zapuskator;

interface ProcessInterface
{

    public function setParameters(array $parameters);

    public function setState($state);

    public function setStacktrace(array $stacktrace);

    public function execute();

}
