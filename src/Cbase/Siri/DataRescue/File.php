<?php
/**
 * Dazz Copyright 2013
 * 
 */

namespace Cbase\Siri\DataRescue;

/**
 * Siri will save this file
 *
 * Class RescueFile
 * @package Cbase\Siri
 */
class File
{
    /** @var \SPLFileInfo */
    private $file;

    /** @var  string */
    private $mimeType;

    public function __construct(\SPLFileInfo $file)
    {
        $this->file = $file;
        $this->mimeType = exec('file -b --mime-type "'. $this->file->getPathname().'"');
    }

    public function __call($name, $arguments)
    {
        return $this->file->$name();
    }

    public function getContentsBase64()
    {
        return base64_encode($this->file->getContents());
    }

    public function getMimeType()
    {
        return $this->mimeType;
    }

    public function getBlockType()
    {
        return strtolower(reset(explode('/', $this->mimeType)));
    }

}
