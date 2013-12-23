<?php
/**
 * Dazz Copyright 2013
 * 
 */

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

$console = new Symfony\Component\Console\Application;

$console
    ->register('siri:storage:id')
    ->setDefinition(array())
    ->setDescription('Import files')
    ->setCode(
        function (InputInterface $input, OutputInterface $output) use ($app) {

            $output->writeln('SIRI storageId: ' . $app['siri.storage.id']);
        }
    );

$console
    ->register('siri:storage:files')
    ->setDefinition(array())
    ->setDescription('SIRI show list of files in storage')
    ->setCode(
        function (InputInterface $input, OutputInterface $output) use ($app) {

            foreach ($app['siri.storage']->getDirectories() as $directory) {
                $output->writeln('directory: '. $directory->getFilename());
                foreach ($app['siri.storage']->getFiles($directory->getFilename()) as $file) {
                    $output->writeln(' file: '. $file->getFilename());                }
            }

        }
    );

$console
    ->register('siri:storage:directories')
    ->setDefinition(array())
    ->setDescription('SIRI show list of storages saved')
    ->setCode(
        function (InputInterface $input, OutputInterface $output) use ($app) {

            foreach ($app['siri.storage']->getDirectories() as $directory) {
                var_dump($directory);
            }
        }
    );


$console
    ->register('siri:info')
    ->setDefinition(array())
    ->setDescription('SIRI show system info')
    ->setCode(
        function (InputInterface $input, OutputInterface $output) use ($app) {
            foreach ($app['siri']->getSystemInfo() as $infoName => $info) {
                $output->writeln($infoName . ': '. $info);
            }
        }
    );

$console
    ->register('siri:storage:info')
    ->setDefinition(array())
    ->setDescription('SIRI show list of storages saved')
    ->setCode(
        function (InputInterface $input, OutputInterface $output) use ($app) {
            foreach ($app['siri.storage']->getInfo() as $infoName => $info) {
                 $output->writeln($infoName . ': '. $info);
            }
        }
    );


return $console;