<?php

/**
 * Created by PhpStorm.
 * User: richard.dickinson
 * Date: 11/11/2018
 * Package: MoveSystem
 * Purpose: Demonstration
 * License: Take what you can - give nothing back (Pirates of the Caribbean)
 */

namespace App\Filesystem\Move\Traits;

use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Trait CustomException
 * @package App\Filesystem\Move\Traits
 */
trait CustomException
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        /**
         * Normally I would never trait this up, it would be written out for each class
         * the reason for that is explicit logging.
         *
         * Anything using this CustomException will log a warning level event.
         * What if 1 was just info level? Emergency level? This is why I would
         * create it unique each time, however, this is an example
         * of a trait being used in good context.
         */

        parent::__construct($message, $code, $previous);
        Log::warning('Exception' . substr(strrchr(__CLASS__, "\\"), 1) . ' - ' . $message);
    }
}