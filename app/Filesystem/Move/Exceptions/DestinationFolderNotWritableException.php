<?php

/**
 * Created by PhpStorm.
 * User: richard.dickinson
 * Date: 11/11/2018
 * Package: MoveSystem
 * Purpose: Demonstration
 * License: Take what you can - give nothing back (Pirates of the Caribbean)
 */

namespace App\Filesystem\Move\Exceptions;

use App\Filesystem\Move\Traits\CustomException;

use \Exception;

/**
 * Class DestinationFolderNotWritableException
 * @package App\Filesystem\Move\Exceptions
 */
class DestinationFolderNotWritableException extends Exception
{
    use CustomException;
}