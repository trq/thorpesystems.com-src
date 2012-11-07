<?php

define('MYPATH', realpath(__DIR__));

require MYPATH . '/vendor/autoload.php';

function getDest($args) { return isset($args['dest']) ? $args['dest'] : __DIR__ . '/build'; }

group('dev', function() {

    desc('Build website');
    task('build', 'compile-less', function($args) {
        $gen = new Gen\Builder(new Gen\Config, new Gen\Util(isset($args['verbose'])));
        $gen->build(MYPATH, getDest($args));
    });

    desc('Serve website locally on 127.0.0.1:<8080>');
    task('serve', 'build', function($args) {
        if (is_dir(getDest($args))) {
            echo "http://127.0.0.1:8080\n";
            chdir(getDest($args));
            system('php -S 127.0.0.1:8080');
        }
    });

    desc('Compile less to css');
    task('compile-less', function($args) {

        $in  = MYPATH . '/resources/my.less';
        $out = getDest($args) . '/assets/css/my.css';

        $less = new lessc;
        $cache = $less->cachedCompile($in);

        if (!is_dir(getDest($args) . '/assets/css')) {
            mkdir(getDest($args) . '/assets/css', 0777, true);
        }

        file_put_contents($out, $cache["compiled"]);

        $last_updated = $cache["updated"];
        $cache = $less->cachedCompile($cache);
        if ($cache["updated"] > $last_updated) {
            file_put_contents($out, $cache["compiled"]);
        }
    });

});

task('default', 'dev:build');
