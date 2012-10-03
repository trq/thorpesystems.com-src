<?php

namespace Gen;

class My extends TwigExtension
{
    public function getFunctions()
    {
        return [];
    }

    public function getName()
    {
        return 'my_extension';
    }
}
