<?php

$blog = new Gen\Blog(new Gen\Util);
return $blog->getIndex(__DIR__, ['index.twig']);
