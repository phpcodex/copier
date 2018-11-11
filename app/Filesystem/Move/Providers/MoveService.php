<?php

/**
 * Created by PhpStorm.
 * User: richard.dickinson
 * Date: 11/11/2018
 * Package: MoveSystem
 * Purpose: Demonstration
 * License: Take what you can - give nothing back (Pirates of the Caribbean)
 */

namespace App\Filesystem\Move\Providers;

use App\Filesystem\Move\Entity\FileResource;
use App\Filesystem\Move\Exceptions\SourceFileNotFoundException;
use App\Filesystem\Move\Exceptions\DestinationFileAlreadyExistsException;
use App\Filesystem\Move\Exceptions\DestinationFolderNotWritableException;
use App\Filesystem\Move\Exceptions\FailedToCopySourceToDestinationException;
use App\Filesystem\Move\Exceptions\FailedToRemoveSourceFileException;

use \Exception;

class MoveService
{
    /**
     * MoveService constructor.
     * @param FileResource $source
     * @param FileResource $destination
     */
    public function __construct(FileResource $source, FileResource $destination)
    {
        $this->source = $source;
        $this->destination = $destination;
    }

    /**
     * @return bool
     * @throws DestinationFileAlreadyExistsException
     * @throws DestinationFolderNotWritableException
     * @throws FailedToCopySourceToDestinationException
     * @throws FailedToRemoveSourceFileException
     * @throws SourceFileNotFoundException
     */
    public function go() : bool
    {
        if (!$this->source->exists()) {
            throw new SourceFileNotFoundException($this->source->get());
        }

        if ($this->destination->exists()) {
            throw new DestinationFileAlreadyExistsException($this->destination->get());
        }

        if (!$this->destination->writable()) {
            throw new DestinationFolderNotWritableException($this->destination->get());
        }

        try {
            copy($this->source->get(), $this->destination->get());
        } catch (Exception $e) {
            throw new FailedToCopySourceToDestinationException($e->getMessage());
        }

        try {
            unlink($this->source->get());
        } catch (Exception $e) {
            throw new FailedToRemoveSourceFileException($e->getMessage());
        }

        return true;
    }
}