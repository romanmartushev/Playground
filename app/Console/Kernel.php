<?php

namespace App\Console;

use App\Member;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        $schedule->call(function () {
//            $members = Member::all();
//            foreach ($members as $member){
//                $check = substr($member->birthday,0, -5);
//                $month = date('m');
//                $day = date('d');
//                $now = $month."/".$day;
//                if($now == $check){
//                    $this->sendMessage($member);
//                }
//            }
//        })->daily();
    }
    public function sendMessage($person){
        $basic  = new \Nexmo\Client\Credentials\Basic(env("Nexmo_API_KEY"), env("Nexmo_API_SECRET"));
        $client = new \Nexmo\Client($basic);

        $date = new \DateTime($person->birthday);
        $now = new \DateTime();
        $age = $now->diff($date);

        $message = $client->message()->send([
            'to' => "12182805085",
            'from' => '12109619101',
            'text' => 'It is '.$person->name.'\'s birthday! He is Turning '.$age->y.'! Wish Him a Happy Birthday his phone number is: '.$person->phone_number
        ]);
    }
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
