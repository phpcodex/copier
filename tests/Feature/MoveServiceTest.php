<?php

/**
 * Created by PhpStorm.
 * User: richard.dickinson
 * Date: 11/11/2018
 * Package: MoveSystem
 * Purpose: Demonstration
 * License: Take what you can - give nothing back (Pirates of the Caribbean)
 */

namespace Tests\Feature;

use App\Filesystem\Move\Controllers\MoveSystem;
use App\Filesystem\Move\Entity\FileResource;
use App\Filesystem\Move\Providers\MoveService;
use App\Filesystem\Move\Exceptions\SourceFileNotFoundException;
use App\Filesystem\Move\Exceptions\DestinationFileAlreadyExistsException;
use App\Filesystem\Move\Exceptions\DestinationFolderNotWritableException;
use App\Filesystem\Move\Exceptions\FailedToCopySourceToDestinationException;
use App\Filesystem\Move\Exceptions\FailedToRemoveSourceFileException;

use Faker\Provider\File;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MoveServiceTest extends TestCase
{
    public function test_for_exception_1()
    {
        $this->source       = new FileResource(storage_path('framework/testing/source_1.txt'));
        $this->destination  = new FileResource(storage_path('framework/testing/destination_1.txt'));

        $this->expectException(SourceFileNotFoundException::class);
        $service = (new MoveService($this->source, $this->destination))->go();
    }

    public function test_for_exception_2()
    {
        $this->expectException(DestinationFileAlreadyExistsException::class);

        $this->source       = new FileResource(storage_path('framework/testing/source_2.txt'));
        $this->destination  = new FileResource(storage_path('framework/testing/destination_2.txt'));

        fopen($this->source->get(), 'w');
        fopen($this->destination->get(), 'w');

        $service = (new MoveService($this->source, $this->destination))->go();

        unlink($this->source->get());
        unlink($this->destination->get());
    }
}