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
            'uptime' => exec('uptime'),
            'uname' => exec('uname -a'),
        ];
    }
}
 