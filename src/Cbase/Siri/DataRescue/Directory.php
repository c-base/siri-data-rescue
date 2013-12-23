<?php
/**
 * Dazz Copyright 2013
 * 
 */

namespace Cbase\Siri\DataRescue;


class Directory
{
    /** @var \SPLFileInfo */
    private $directory;

    public function __construct(\SPLFileInfo $directory){

        $this->directory = $directory;
    }

    public function __call($name, $arguments)
    {
        return $this->directory->$name();
    }

    public function countFiles()
    {
        $iterator = new \GlobIterator($this->directory->getPathname().'/*.*');
        return $iterator->count();
    }
}
 