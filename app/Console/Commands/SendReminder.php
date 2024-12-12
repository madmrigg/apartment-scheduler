<?php

namespace App\Console\Commands;

use App\Mail\ReminderEmail;
use App\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $date = date('Y-m-d');
        $tasks = app(Task::class)->whereDate('datetime', date("Y-m-d"))->get();

        foreach ($tasks as $task) {
            Mail::to($task->user->email)
                ->send(new ReminderEmail());
        }
    }
}
