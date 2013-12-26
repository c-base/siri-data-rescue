<?php
/**
 * Dazz Copyright 2013
 * 
 */

namespace Cbase\Siri\DataRescue;


class Storage
{
    /**
     * @var \Closure
     */
    private $finder;
    private $path;

    public function __construct(\Closure $finder, $path)
    {
        $this->finder = $finder;
        $this->path = $path;
    }

    /**
     * @return \Symfony\Component\Finder\Finder $finder
     */
    private function createFinder()
    {
        $finder = $this->finder;
        return $finder();
    }

    public function getInfo($size = '<= 5M')
    {
        $files = $this
            ->createFinder()
            ->files()
            ->in($this->path)
            ->size($size)
            ->sortByModifiedTime()
        ;

        $arrayFromIterator = iterator_to_array($files, false);
        $files = array_reverse($arrayFromIterator);
//        $files = new \ArrayIterator($arrayFromIterator);

        /** @var \SPLFileInfo $oldestFile */
        $oldestFile = $arrayFromIterator[0];
        /** @var \SPLFileInfo $youngestFile */
        $youngestFile = $files[0];

        $sorages = $this
            ->createFinder()
            ->directories()
            ->in($this->path)
            ->depth(0)
            ;

        $directories = $this
            ->createFinder()
            ->directories()
            ->in($this->path)
            ->sortByModifiedTime()
            ;

       return [
            'num_storage'  => $sorages->count(),
            'directories_in_storages' => $directories->count() - $sorages->count(),
            'num_files'    => count($files),
            'oldest'       => $oldestFile->getFilename(),
            'oldest_date'  => date('Y-m-d H:i:s', $oldestFile->getMTime()),
            'youngest'     => $youngestFile->getFilename(),
           'youngest_date' => date('Y-m-d H:i:s', $youngestFile->getMTime())
        ];
    }

    public function getDirectories()
    {
        $finder = $this
            ->createFinder()
            ->directories()
            ->in($this->path)
            ->depth(0)
            ->sortByModifiedTime()
        ;

        $directories = [];
        foreach ($finder as $directory) {
            $directories[] = new Directory($directory);
        }

        return array_reverse($directories);
    }

    public function getFiles($storageId, $size = '<= 5M')
    {
        if (empty($storageId)) {
            return null;
        }

        $path = $this->path . '/' . $storageId. '/';

        $finder = $this
            ->createFinder()
            ->files()
            ->in($path)
            ->size($size);

        $files = [];
        foreach ($finder as $file) {
            $files[] = new File($file);
        }

        return $files;
    }

    public function getCurrentId($path, $name = 'storage_id')
    {
        $finder = $this
            ->createFinder()
            ->files()
            ->in($path)
            ->name($name)
            ->depth(0);

        foreach ($finder as $file) {
            return $file->getContents();
        }

        return null;
    }
}
 