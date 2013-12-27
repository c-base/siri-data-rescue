<?php

use Silex\Application;

$app = new Application(['debug' => true]);

$app['root'] = __DIR__.'/..';

$app->register(new \Cbase\Siri\DataRescue\DataRescueServiceProvider);
$app->register(new \Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => $app['root'].'/views',
));

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
$app->get('/storage/{storageId}', function ($storageId) use ($app) {
    return $app['twig']->render(
        'show.twig',
        [
            'storageId'    => $storageId,
            'storageFiles' => $app['siri.storage']->getFiles($storageId),
        ]);
});
$app->get('/speicher/{storageId}', function ($storageId) use ($app) {
    return $app['twig']->render(
        'show.twig',
        [
            'storageId'    => $storageId,
            'storageFiles' => $app['siri.storage']->getFiles($storageId),
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
return $app;
