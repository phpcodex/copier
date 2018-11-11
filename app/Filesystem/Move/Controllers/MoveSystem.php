<?php

/**
 * Created by PhpStorm.
 * User: richard.dickinson
 * Date: 11/11/2018
 * Package: MoveSystem
 * Purpose: Demonstration
 * License: Take what you can - give nothing back (Pirates of the Caribbean)
 */

namespace App\Filesystem\Move\Controllers;

use App\Filesystem\Move\Entity\FileResource;
use App\Filesystem\Move\Exceptions\DestinationFileAlreadyExistsException;
use App\Filesystem\Move\Exceptions\DestinationFolderNotWritableException;
use App\Filesystem\Move\Exceptions\FailedToCopySourceToDestinationException;
use App\Filesystem\Move\Exceptions\FailedToRemoveSourceFileException;
use App\Filesystem\Move\Exceptions\SourceFileNotFoundException;
use App\Filesystem\Move\Providers\MoveService;
use Illuminate\Support\Facades\Log;

/**
 * Class MoveSystem
 * @package App\Filesystem\Move\Controllers
 */
class MoveSystem
{
    private $source;
    private $destination;

    /**
     * MoveSystem constructor.
     * @param FileResource $source
     * @param FileResource $destination
     */
    public function __construct(FileResource $source, FileResource $destination)
    {
        /**
         * We are just wanting to initialise our system here. At Controller
         * level, we are the glue for all the services.
         *
         * EG: Chrome is an Application (System) that will use the libraries
         * built into windows as Providers.
         */

        Log::info('Try to move a file');
        Log::info('    Source: ' . $source->get());
        Log::info('    Destination: ' . $destination->get());

        $this->source = $source;
        $this->destination = $destination;

    }

    /**
     * MoveSystem process
     * @return bool
     */
    public function process() : bool
    {
        $hasMoved = false;

        /**
         *  Part of the Systems job is to handle the exception and react to it.
         *  Our service has told us something about what happened, but our
         *  application may want to do something about this.
         *
         *  - This could be to either attempt it again
         *  - It could be to just not do anything more
         *  - Or now it could be email someone.
         */

        try {
            $hasMoved = (new MoveService($this->source, $this->destination))->go();
        } catch (DestinationFileAlreadyExistsException $e) {
        } catch (DestinationFolderNotWritableException $e) {
        } catch (FailedToCopySourceToDestinationException $e) {
        } catch (FailedToRemoveSourceFileException $e) {
        } catch (SourceFileNotFoundException $e) {
        }

        /**
         * As we are handling all of the possible exceptions provided by
         * the Service, we will continue gracefully and only die
         * if another exception is thrown that we are not handling.
         */

        if ($hasMoved) {
            Log::info('Successful');
        } else {
            Log::info('Something went wrong');
        }

        return $hasMoved;
    }
}