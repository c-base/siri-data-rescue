<?php

use Silex\Application;

$app = new Application(['debug' => true]);

$app['root'] = __DIR__.'/..';

$app->register(new \Cbase\Siri\DataRescue\DataRescueServiceProvider);
$app->register(new \Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => $app['root'].'/views',
));
$app->register(new \Nicl\Silex\MarkdownServiceProvider());

$app->get('/', function () use ($app) {
    return $app['twig']->render(
        'index.twig',
        [
            'siriState' => $app['siri']->getState(),
            'siriInfo' => $app['siri']->getSystemInfo(),
            'storageInfo' => $app['siri.storage']->getInfo(),
            'storageDirectories' => $app['siri.storage']->getDirectories(),
            'storageId' => $app['siri.storage.id'],
        ]
    );
});

$app->get('/speicher/{storageId}', function ($storageId) use ($app) {

    $webpath = sprintf('%s/%s/', $app['siri.storage.webpath'], $storageId);

    return $app['twig']->render(
        'show.twig',
        [
            'storageId'    => $storageId,
            'storageFiles' => $app['siri.storage']->getFiles($storageId),
            'webpath'      => $webpath,
        ]);
});

$app->get('/anleitung', function () use ($app) {
        return $app['twig']->render('anleitung.twig');
    }
);

$app->get('/siri-sonde', function () use ($app) {
        return $app['twig']->render('info.twig');
    }
);
$app->get('/status', function () use ($app) {
        return $app['twig']->render('status.twig');
    }
);
return $app;
