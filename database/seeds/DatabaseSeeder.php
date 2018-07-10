<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
       $this->call('UsersSeeder');
    }
}

class DivisionsSeeder extends Seeder
{    
    public function run()
    {       
        DB::table('divisions')->insert([
            'name'          => 'Fantasy',
            'leader_id'     => '1',
            'description'   => 'Happy Friends',
            'avatar'        => 'abcd1.jpg',
        ]);
        DB::table('divisions')->insert([
            'name' => 'Kimochi',
            'leader_id' => '2',
            'description' => 'This is my family',
            'avatar' => 'abcd2.jpg',
        ]);         
    }
}

class MemberMailsSeeder extends Seeder
{
    public function run()
    {
        DB::table('member_mails')->insert([
            'content'       => 'Time-off request',
            'time_start'    => '8h 15/7/2017',
            'time_end'      => '12h 15/7/2017',
            'status'        => 'done',
            'admin_status'  => 'seen',
            'time_send'     => '18h 14/07/2017',
            'users_id'      => '1',
            'reason'        => 'I very tired',
        ]);
        DB::table('member_mails')->insert([
            'content'       => 'Time-off request',
            'time_start'    => '8h 16/7/2017',
            'time_end'      => '12h 16/7/2017',
            'status'        => 'done',
            'admin_status'  => 'seen',
            'time_send'     => '18h 14/07/2017',
            'users_id'      => '2',
            'reason'        => 'sick',
        ]);        
    }
}

class NotificationsSeeder extends Seeder
{
    public function run()
    {
        DB::table('notifications')->insert([
            'title'     => 'Update salary',
            'content'   => 'Review of this month',
            'time_send' => '18/06/2017',
        ]);
        DB::table('notifications')->insert([
            'title'     => 'Update salary',
            'content'   => 'Review of this month',
            'time_send' => '18/06/2017',
        ]);        
    }
}

class UserNotificationsSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_notifications')->insert([
            'notifications_id'   => '1',
            'users_id'     => '1',
            'status' => 'seen',
        ]);
        DB::table('user_notifications')->insert([
            'notifications_id'   => '1',
            'users_id'     => '2',
            'status' => 'unseen',
        ]);
        DB::table('user_notifications')->insert([
            'notifications_id'   => '2',
            'users_id'     => '1',
            'status' => 'seen',
        ]);
        DB::table('user_notifications')->insert([
            'notifications_id'   => '2',
            'users_id'     => '2',
            'status' => 'seen',
        ]);
    }
}
class TeamsSeeder extends Seeder
{
    public function run()
    {
        DB::table('teams')->insert([
            'name'          => 'A',
            'leader_id'     => '1',       
            'description'   => 'The Coolest',
            'avatar'        => 'xyz.jpg',
            'divisions_id'  => '1',
        ]);
        DB::table('teams')->insert([
            'name'          => 'B',
            'leader_id'     => '2',
            'description'   => 'The hot team',
            'avatar'        => 'xyzt.jpg',
            'divisions_id'  => '1',
        ]);
    }
}

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name'                  => 'superadmin',
            'email'                 => 'superadmin@hblab.vn',
            'password'              =>  Hash::make('123456'),
            'level'                 => '1',
            'fullname'              => 'Super Admin',
            'birth_day'             => '',
            'gender'                => 'Male',
            'avatar'                => 'icon_user.png',
            'address'               => '',
            'phone_number'          => '',
            'day_into'              => '',
            'salary'                => '',
            'teams_id'              => '0',
            'teams_divisions_id'    => '0',
        ]);
        DB::table('users')->insert([
            'name'                  => 'admin',
            'email'                 => 'admin@hblab.vn',
            'password'              =>  Hash::make('123456'),
            'level'                 => '2',
            'fullname'              => 'Admin',
            'birth_day'             => '',
            'gender'                => 'Male',
            'avatar'                => 'icon_user.png',
            'address'               => '',
            'phone_number'          => '',
            'day_into'              => '',
            'salary'                => '',
            'teams_id'              => '0',
            'teams_divisions_id'    => '0',
        ]);
    }
}

class ProfilesSeeder extends Seeder
{
    public function run()
    {
        
    }
}


class UserProfilesSeeder extends Seeder
{
    public function run()
    {

    }
}


