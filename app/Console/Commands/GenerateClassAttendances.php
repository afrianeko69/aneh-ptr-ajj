<?php

namespace App\Console\Commands;

use App\Events\ListKelasSayaEvent;
use App\User;
use Illuminate\Console\Command;

class GenerateClassAttendances extends Command
{
    private $min = 1;
    private $max = 10;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'class-attendance:generate {--table= : The Table of the user}
                        {--min= : The Min ID of the user} {--max= : The Max ID of the user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Class Attendances From LMS to Pintaria';

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
        $min = $this->option('min');
        $max = $this->option('max');

        $min ? $this->min = $min : '';
        $max ? $this->max = $max : '';

        foreach (User::whereNotNull('provider_id')
                     ->where('id', '>=', $this->min)
                     ->where('id', '<=', $this->max)
                     ->doesntHave('courses')
                     ->orderBy('id')
                     ->cursor() as $user) {

            event(new ListKelasSayaEvent($user));
        }
    }
}
