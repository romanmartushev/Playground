<?php

namespace App\Console\Commands;

use App\Text;
use Illuminate\Console\Command;

class DeleteAllTexts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:deleteTexts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes all text messages';

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
        Text::truncate();
        return 0;
    }
}
