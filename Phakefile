<?php

define('MYPATH', realpath(__DIR__));

$conf = [
    'port' => 8080,
];

$conf['gen']  = include MYPATH . '/gen.conf.php';
$conf['dest'] = MYPATH . '/' . $conf['gen']['dest'];

require MYPATH . '/vendor/autoload.php';
include MYPATH . '/resources/lib/My/My.php';
$my = new My\My($conf);

group('dev', function() use ($my) {

    desc('Build website');
    task('build', 'compile-less', function($args) use ($my) {
        $my->setFromArgs($args);
        $gen = new Gen\Builder(new Gen\Config, new Gen\Util(isset($args['verbose'])));
        $gen->build(MYPATH, $my->getConf('dest'));
    });

    desc('Serve website locally on 127.0.0.1:<8080>');
    task('serve', 'build', function($args) use ($my) {
        $my->setFromArgs($args);

        if (is_dir($my->getConf('dest'))) {
            echo "http://127.0.0.1:" . $my->getConf('port') . "\n";
            chdir($my->getConf('dest'));
            system('php -S 127.0.0.1:' . $my->getConf('port'));
        }
    });

    desc('Compile less to css');
    task('compile-less', function($args) use ($my) {
        $my->setFromArgs($args);

        $in  = MYPATH . '/resources/my.less';
        $out = $my->getConf('dest') . '/assets/css/my.css';

        $less = new lessc;
        $cache = $less->cachedCompile($in);

        if (!is_dir($my->getConf('dest') . '/assets/css')) {
            mkdir($my->getConf('dest') . '/assets/css', 0777, true);
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
