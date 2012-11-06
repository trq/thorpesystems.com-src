<?php

namespace Gen\Twig;

class My extends ExtensionBase
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
