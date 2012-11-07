<?php

return (new Gen\Indexer('blogs', new Gen\Util))
    ->build(__DIR__, ['index.twig'])
    ->get();
