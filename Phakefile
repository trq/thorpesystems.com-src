<?php

define('MYPATH', realpath(__DIR__));

$conf = [];
$conf['gen'] = include MYPATH . '/gen.conf.php';

include MYPATH . '/resources/lib/My/My.php';
$my = new My\My;

group('dev', function() use ($conf) {

    desc('Build website');
    task('build', function($args) use ($conf) {
        $verbose = false;
        if (isset($args['verbose'])) {
            $verbose = true;
        }

        if (isset($args['dest'])) {
            $dest = $args['dest'];
        } else {
            $dest = MYPATH . '/' . $conf['gen']['build'];
        }

        require MYPATH . '/vendor/autoload.php';

        $gen = new Gen\Gen($verbose);
        $gen->build(MYPATH, $dest);
    });

    desc('Serve website locally on 127.0.0.1:<8080>');
    task('serve', 'build', function($args) use ($conf) {
        $port = '8080';
        if (isset($args['port'])) {
            $port = $args['port'];
        }

        if (is_dir(MYPATH . '/' . $conf['gen']['build'])) {
            echo "http://127.0.0.1:$port\n";
            chdir(MYPATH . '/' . $conf['gen']['build']);
            system('php -S 127.0.0.1:' . $port);
        }
    });

    desc('Compile less to css');
    task('compile-less', function() use ($conf) {
        $in  = MYPATH . '/resources/my.less';
        $out = MYPATH . '/' . $conf['gen']['build'] . '/assets/css/my.css';

        $less = new lessc;
        $cache = $less->cachedCompile($in);
        file_put_contents($out, $cache["compiled"]);

        $last_updated = $cache["updated"];
        $cache = $less->cachedCompile($cache);
        if ($cache["updated"] > $last_updated) {
            file_put_contents($out, $cache["compiled"]);
        }
    });

});

task('default', 'dev:build');
