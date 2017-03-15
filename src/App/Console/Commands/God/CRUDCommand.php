<?php

namespace App\Console\Commands\God;

use Illuminate\Console\Command;

class CRUDCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'god:crud {table} {model}';

    /**
     * @var string
     */
    protected $description = 'Create CRUD class';

    public function handle()
    {
       

    }
}
