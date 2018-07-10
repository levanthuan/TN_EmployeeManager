<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\CreateNotificationRequest;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotification;
use Carbon\Carbon;
use Auth;
use View;
use Mail;
class NotificationController extends Controller
{

	public function getNotifications(){
        $admin = User::where('level', 2)->first();
		$notifications = Notification::orderBy('id', 'desc')->paginate(5);
		return view('admin.content.notifications', ['notifications' => $notifications, 'admin' => $admin]);
	}

    public function getNotification($id){
        $user = Auth::user();
        $admin = User::where('level', 2)->first();
        $notification = Notification::find($id);
        if ($user->level <= 2) {
            return view('admin.content.notification', ['notification' => $notification, 'admin' => $admin]);
        }
        $userNotification = UserNotification::where('users_id', $user->id)->where('notifications_id', $id)->first();
        $userNotification->status = "seen";
        $userNotification->save();
        return view('user.content.notification', ['notification' => $notification]);
    }
    public function getNotificationsUser(){
        $userId = Auth::user()->id;
        $admin = User::where('level', '2')->first();
        $notificationsUser = UserNotification::orderBy('created_at', 'desc')->where('users_id', $userId)->paginate(10);
        return view('user.content.notifications', ['notificationsUser' => $notificationsUser, 'admin' => $admin]);
    }
    public function getCreateNotification()
    {
        return view('admin.content.create_notification');
    }
    public function postCreateNotification(CreateNotificationRequest $request)
    {
        $notification = new Notification;
        $listUser = User::all();
        if ($request->ck_send_system == 'on') {
            $notification->title = $request->title;
            $notification->content = $request->content;
            $notification->time_send = Carbon::now('Asia/Ho_Chi_Minh');
            $notification->save();
            $id_last_notification = Notification::all()->last()->id;
            foreach ($listUser as $user) {
                $userNotification = new UserNotification;
                $userNotification->notifications_id = $id_last_notification;
                $userNotification->users_id = $user->id;
                $userNotification->status = 'unseen';
                $userNotification->save();
            }
        }
        if ($request->ck_send_email == 'on') {
            $title = $request->title;
            $data = ['content' => $request->content, 'title' => $title];
            Mail::send('admin.content.notification_mail', $data, function($msg) use($listUser, $title){
                foreach ($listUser as $user) {
                    $msg->to( $user->email , 'Admin')->subject($title);
                }
            });
        }
        return redirect()->route('admin_create_notification')
            ->with('notification', 'Create a new notification successfully!');
    }
}