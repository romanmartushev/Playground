<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \Nexmo\Client\Credentials\Basic;
use \Nexmo\Client;
use App\Member;

class checkBirthdays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks for birthdays and sends texts';

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
     * @throws \Nexmo\Client\Exception\Exception
     * @throws \Nexmo\Client\Exception\Request
     * @throws \Nexmo\Client\Exception\Server
     */
    public function handle()
    {
        $members = Member::all();
        $birthdayToday = [];
        foreach ($members as $member){
            $check = substr($member->birthday,0, -5);
            $month = date('m');
            $day = date('d');
            $now = $month."/".$day;
            if($now == $check){
                array_push($birthdayToday,$member);
            }
        }
        if(!empty($birthdayToday)){
            $message = "";
            foreach($birthdayToday as $person){
                $date = new \DateTime($person->birthday);
                $now = new \DateTime();
                $age = $now->diff($date);
                $message .= ' '.$person->name.' turned '.$age->y.' today! ';
            }
            $message .= ' Wish them a Happy Birthday!';
            $this->sendMessage($message);
        }
    }

    /**
     * @param string $message
     * @throws \Nexmo\Client\Exception\Exception
     * @throws \Nexmo\Client\Exception\Request
     * @throws \Nexmo\Client\Exception\Server
     */
    public function sendMessage($message){
        $numbers = ["12182805085","15034386036","14063811446","2182807450"];
        $basic  = new Basic(env("Nexmo_API_KEY"), env("Nexmo_API_SECRET"));
        $client = new Client($basic);
        foreach($numbers as $number) {
            $client->message()->send([
                'to' => $number,
                'from' => '12109619101',
                'text' => $message
            ]);
        }
    }
}
