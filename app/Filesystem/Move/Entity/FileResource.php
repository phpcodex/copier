<?php

/**
 * Created by PhpStorm.
 * User: richard.dickinson
 * Date: 11/11/2018
 * Package: MoveSystem
 * Purpose: Demonstration
 * License: Take what you can - give nothing back (Pirates of the Caribbean)
 */

namespace App\Filesystem\Move\Entity;

/**
 * Class FileResource
 * @package App\Filesystem\Move\Entity
 */
class FileResource
{
    public function __construct(string $resource)
    {
        /**
         * We are just a resource storage entity. At this point
         * we don't know what we want to do with this object
         * except store the name.
         */

        $this->resource = $resource;
    }

    public function get() : string
    {
        /**
         * Upon initial conception of this object, you would
         * generally know you need to 'get' the stored
         * value back out.
         */

        return $this->resource;
    }

    public function exists() : bool
    {
        /**
         * During writing the code, I eventually realised I
         * needed to check if the file exists, it goes
         * here because the resource may no longer
         * be local - sFTP perhaps?
         */

        return file_exists($this->resource);
    }

    public function writable() : bool
    {
        /**
         * While developing, it's easy to overlook the simple
         * things, but I decided as a test, to see if
         * our resource is writable. Again, it's done
         * here so any code checking uses the
         * same method.
         */

        /**
         * When I say same method, I mean currently this is locally,
         * if we was an S3 bucket or network drive, or Google Drive,
         * how we check something being writable will differ,
         * making the below code redundant.
         *
         * If that ever does happen, I only need to implement the
         * change in this file providing everywhere is using this
         * accessible method and not written their own.
         */

        return is_writable(pathinfo($this->resource)['dirname']);
    }
}