<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Model\User;

use Illuminate\Http\Request;

use App\Model\Request as RequestData;

use Carbon\Carbon;

use Config;

use DB;

use App\Notification;

class NotifyUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'curenik:notifyUsers';

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
    public function handle(Request $request)
    {
        $database_name = 'db_curenik';
        $default = [
            'driver' => env('DB_CONNECTION','mysql'),
            'host' => env('DB_HOST'),
            'port' => env('DB_PORT'),
            'database' => $database_name,
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null
        ];
        
        Config::set("database.connections.$database_name", $default);

        DB::setDefaultConnection($database_name);

        $timezone = $request->header('timezone');
        if(!$timezone){
            $timezone = 'Asia/Kolkata';
        }
       

        $currentdate = Carbon::now()->format('Y-m-d H:i:s');
        
        $fivecurrentdate=Carbon::now()->addMinutes('5')->format('Y-m-d H:i:s');
        
        $fiveminuteNotifications = RequestData::where(['user_status'=>'pending'])->whereBetween('booking_date',[$currentdate,$fivecurrentdate])->get();
        //dd($fiveminuteNotifications);
        foreach ($fiveminuteNotifications as $key => $fiveDaysNotification) {
            $notification = new Notification();
            $notification->sender_id = 1;
            $notification->receiver_id = $fiveDaysNotification->to_user;
            $notification->module ='reminder';
            $notification->notification_type ='REMINDER';
            $notification->message =__('Your Booking will is in next 5 minutes.');
            $notification->save();
            $notification->push_notification(array($fiveDaysNotification->to_user),array('pushType'=>'Reminder','message'=>__('Your Booking is in next 5 minutes.')));
        }
    }
}
