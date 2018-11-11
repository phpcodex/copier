<?php

/**
 * Created by PhpStorm.
 * User: richard.dickinson
 * Date: 11/11/2018
 * Package: MoveSystem
 * Purpose: Demonstration
 * License: Take what you can - give nothing back (Pirates of the Caribbean)
 */

namespace Tests\Unit;

use App\Filesystem\Move\Entity\FileResource;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FileResourceTest extends TestCase
{

    public function test_file_resource_doesnt_transform()
    {
        $filename = storage_path('framework/testing/TrAnSfOrM.txt');
        $resource = new FileResource($filename);

        $this->assertEquals($resource->get(), $filename);
    }

    public function test_file_exists_in_path()
    {
        $filename   = storage_path('framework/testing/file_exists.txt');
        fopen($filename, 'w');

        $resource   = new FileResource($filename);

        $this->assertTrue($resource->exists());
        unlink($filename);
    }

    public function test_file_directory_is_writable()
    {
        $filename   = storage_path('framework/testing/writable_check.txt');
        fopen($filename, 'w');

        $resource   = new FileResource($filename);

        $this->assertTrue($resource->writable());
        unlink($filename);
    }
}
