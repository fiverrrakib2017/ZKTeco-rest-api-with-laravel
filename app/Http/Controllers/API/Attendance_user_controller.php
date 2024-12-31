<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attendance_user;
use Illuminate\Http\Request;
use Rats\Zkteco\Lib\ZKTeco;

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
        $attendaces = $zk->getAttendance();


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
}
