<?php
/**
 * Dazz Copyright 2013
 * 
 */

namespace Cbase\Siri;


class Siri
{
    public function getState()
    {
        return 'alles ist gut';
    }

    public function getSystemInfo()
    {
        return [
            'specs' => '
* zwei flügel
* 7.5KW ionenstrahltriebwerk
* MEMS-Gyro
* 2^53kB holographischer Speicher
* Dual Personality-AI-Interface
* 500W-Radiothermalgenerator mit Backupbatterie',
            'uptime' => exec('uptime'),
            'uname' => exec('uname -a'),
        ];
    }
}
 