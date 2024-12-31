<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Attendance_user;
use Rats\Zkteco\Lib\ZKTeco;
class SyncAttendanceUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:attendance-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync attendance users from ZKTeco device';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $deviceIp = env('ZKTeco_IP_ADDRESS', '192.168.0.103');
        $devicePort = env('ZKTeco_PORT', 8088);

        $zk = new ZKTeco($deviceIp, $devicePort);

        try {
            $zk->connect();
            $zk->disableDevice();

            $users = $zk->getUser();

            foreach ($users as $user) {
                Attendance_user::updateOrCreate(
                    [
                        'uid' => $user['uid'],
                    ],
                    [
                        'device_ip' => $deviceIp,
                        'device_name' => 'ZKTeco',
                        'user_id' => $user['userid'],
                        'name' => $user['name'],
                        'role' => $user['role'],
                        'password' => $user['password'],
                        'cardno' => trim($user['cardno']),
                    ]
                );
            }

            $zk->enableDevice();
            $zk->disconnect();

            $this->info('Attendance users synced successfully.');
        } catch (\Exception $e) {
            $this->error('Failed to sync attendance users: ' . $e->getMessage());
        }

        return 0;
    }
}
