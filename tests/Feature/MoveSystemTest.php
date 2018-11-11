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
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MoveSystemTest extends TestCase
{
    public function test_we_can_move_file()
    {
        $fileA   = storage_path('framework/testing/source.txt');
        $fileB   = storage_path('framework/testing/destination.txt');

        fopen($fileA, 'w');

        $fileA   = new FileResource($fileA);
        $fileB   = new FileResource($fileB);

        $moveSystem = new MoveSystem($fileA, $fileB);

        $this->assertTrue($moveSystem->process());
        $this->assertTrue($fileB->exists());
        $this->assertFalse($fileA->exists());

        unlink($fileB->get());
    }

    public function test_unable_to_move_file()
    {
        $filename   = storage_path('framework/testing/a.txt');
        fopen($filename, 'w');

        $resource   = new FileResource($filename);
        $moveSystem = new MoveSystem($resource, $resource);

        $this->assertFalse($moveSystem->process());

        unlink($filename);
    }
}
