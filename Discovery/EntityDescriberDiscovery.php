<?php

namespace mbartok\EntityDescriberBundle\Discovery;

use Doctrine\Common\Annotations\Reader;
use mbartok\EntityDescriberBundle\Annotation\EntityDescriber;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class EntityDescriberDiscovery
{
    /**
     * @var string
     */
    private $namespace;

    /**
     * @var string
     */
    private $directory;

    /**
     * @var Reader
     */
    private $annotationReader;

    /**
     * The Kernel root directory
     * @var string
     */
    private $rootDir;

    /**
     * @var array
     */
    private $describers = [];

    /**
     * Discovery constructor.
     *
     * @param string $namespace
     * @param string $directory
     * @param string $rootDir
     * @param Reader $annotationReader
     */
    public function __construct($namespace, $directory, $rootDir, Reader $annotationReader)
    {
        $this->namespace = $namespace;
        $this->annotationReader = $annotationReader;
        $this->directory = $directory;
        $this->rootDir = $rootDir;
    }

    /**
     * Returns all the workers
     */
    public function getDescribers()
    {
        if (!$this->describers) {
            $this->discoverDescribers();
        }
        return $this->describers;
    }

    /**
     * Discovers describers
     */
    private function discoverDescribers()
    {
        $path = $this->rootDir . '/../src/' . $this->directory;
        $finder = new Finder();
        $finder->files()->in($path);
        /** @var SplFileInfo $file */
        foreach ($finder as $file) {
            $class = new \ReflectionClass($this->namespace . '\\' . $file->getBasename('.php'));
            $annotation = $this->annotationReader->getClassAnnotation($class, 'mbartok\EntityDescriberBundle\Annotation\EntityDescriber');
            if (!$annotation) {
                continue;
            }
            if (!$class->implementsInterface('mbartok\EntityDescriberBundle\Model\EntityDescriberInterface')) {
                continue;
            }
            /** @var EntityDescriber $annotation */
            $this->describers[$class->getName()] = [
                'describer' => $annotation->getDescriber(),
                'annotation' => $annotation
            ];
        }
    }
}