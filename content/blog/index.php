<?php

$blog = new Gen\Blog(new Gen\Util);
$blog->buildIndex(__DIR__, ['index.twig']);
return $blog->getIndex();
