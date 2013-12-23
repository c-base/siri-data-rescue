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

        $iterator = new \FilesystemIterator($this->directory->getPathname(), \FilesystemIterator::SKIP_DOTS);
        return iterator_count($iterator);
    }

    public function countSubdirectories()
    {
        $iterator = new \RecursiveDirectoryIterator($this->directory->getPathname());
        return iterator_count($iterator->getChildren(false));
    }
}
 