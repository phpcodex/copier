<?php

/**
 * Created by PhpStorm.
 * User: richard.dickinson
 * Date: 11/11/2018
 * Package: MoveSystem
 * Purpose: Demonstration
 * License: Take what you can - give nothing back (Pirates of the Caribbean)
 */

namespace App\Console\Commands;

use App\Filesystem\Move\Controllers\MoveSystem;
use App\Filesystem\Move\Entity\FileResource;

use Illuminate\Console\Command;

class Move extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'files:move {file} {destination}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Move your chosen file to a chosen destination';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /**
         * This is the command we are going to run. Small, compact and
         * light-weight. This helps in refactoring for any other
         * system you may wish to inherit the usage of
         *
         * CodeIgniter
         * ZendFramework 3
         * Falcon
         * Symfony
         */

        $source = new FileResource(storage_path('app/Filesystem/' . $this->argument('file')));
        $destination = new FileResource(storage_path('app/Filesystem/' . $this->argument('destination')));
        $moved = (new MoveSystem($source, $destination))->process();

        echo ($moved) ? 'YAY' : 'NAY';
    }
}
