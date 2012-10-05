<?php

namespace My;

class My
{
    protected $conf;

    public function __construct(array $conf)
    {
        $this->conf = $conf;
    }

    public function getConf($key)
    {
        if (isset($this->conf[$key])) {
            return $this->conf[$key];
        }
    }

    public function setConf($key, $value)
    {
        $this->conf[$key] = $value;
    }

    public function setFromArgs($args)
    {
        foreach ($args->getIterator() as $k => $v) {
            $this->conf[$k] = $v;
        }
    }
}
