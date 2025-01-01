<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attendance_user;
use Illuminate\Http\Request;
use Rats\Zkteco\Lib\ZKTeco;
use Illuminate\Support\Facades\Log;

class Attendance_user_controller extends Controller
{
    public function get_attendance_user(){
        $users = Attendance_user::all();
        return response()->json(['data' => $users], 200);
    }
    public function add_attendance_user(Request $request){
        $deviceip = env('ZKTeco_IP_ADDRESS', '192.168.0.103');
        $deviceport = env('ZKTeco_PORT', 8088);

        $uid = $request->uid;
        $userid = $request->userid;
        $name = $request->name;
        // $role = (int)$request->role;
        $role = 0;
        $password = $request->password;
        $cardno = $request->cardno;
        $zk = new ZKTeco($deviceip,8088);
       $zk->connect();
       $zk->disableDevice();
       $result=$zk->setUser($uid , $userid , $name , $role , $password , $cardno);
        return response()->json(['success' => true, 'message' => 'Success'], 200);
    }
    public function machine_attendance_user(){
        $deviceip = env('ZKTeco_IP_ADDRESS', '192.168.0.103');
        $deviceport = env('ZKTeco_PORT', 8088);

        /*ZKTeco Connect with Device*/
        $zk = new ZKTeco($deviceip, $deviceport);
        $zk->connect();
        $zk->disableDevice();

        /*Collect User Data From Machine*/
        $users = $zk->getUser();
        return $users;
    }
    public function syncAttendanceUsers(){
        $deviceIp = env('ZKTeco_IP_ADDRESS', '192.168.0.103');
        $devicePort = env('ZKTeco_PORT', 8088);

        $zk = new ZKTeco($deviceIp, $devicePort);
        $zk->connect();
        $zk->disableDevice();
        $users = $zk->getUser();

        foreach ($users as $user) {
            $attendanceUser = new Attendance_user();
            $attendanceUser->device_ip = $deviceIp;
            $attendanceUser->device_name = 'ZKTeco';
            $attendanceUser->uid = $user['uid'];
            $attendanceUser->user_id = $user['userid'];
            $attendanceUser->name = $user['name'];
            $attendanceUser->role = $user['role'];
            $attendanceUser->password = $user['password'];
            $attendanceUser->cardno = trim($user['cardno']);
            $attendanceUser->save();
        }


        $zk->enableDevice();
        $zk->disconnect();

        return response()->json(['success' =>true, 'message' => 'Users synced successfully'], 200);
    }
    public function machine_attendance_list() {
        $deviceip = env('ZKTeco_IP_ADDRESS', '192.168.0.103');
        $deviceport = env('ZKTeco_PORT', 8088);
        $zk = new ZKTeco($deviceip, $deviceport);
        try {
            if ($zk && $zk->connect()) {
                $logs = $zk->getAttendance();
                $zk->disconnect();

                if (!empty($logs)) {
                    return response()->json(['success' => true, 'data' => $logs], 200);
                } else {
                    return response()->json(['success' => false, 'message' => 'No attendance data found'], 404);
                }
            }
            return response()->json(['success' => false, 'message' => 'Failed to connect to device'], 500);
        } catch (\Exception $e) {
            Log::error('Get attendance error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function device_data_clear_attendance()
    {
        $deviceip = env('ZKTeco_IP_ADDRESS', '192.168.0.103');
        $deviceport = env('ZKTeco_PORT', 8088);
        $zk = new ZKTeco($deviceip, $deviceport);
        $zk->connect();
       $zk->disableDevice();
        $zk->clearAttendance();

        return response()->json(['success' => true, 'message' => 'Attendance cleared successfully'], 200);
    }


}
