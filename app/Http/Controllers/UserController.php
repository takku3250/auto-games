<?php
namespace App\Http\Controllers;

use App\Mail\SampleNotification;
use Illuminate\Http\Request;
use App\Library\Message;   // for new Message;
use App\Events\SendMessage; // for MessageSent::dispatch()
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Chat;
use App\Models\User;
class UserController extends Controller
{
  
    public function room(Chat $chat)
    {
        dd($chat->guest()->where('guest_id',Auth::id())->get());
        $is_match_user=$user->guest()->where('guest_id',Auth::id())->exists();
        //$auth = User::find(Auth::id());
        // $is_match_user = $auth->matches()->get()->pluck('id')->contains($user->id);
        
        if ($is_match_user) {

            //get_room_messages()はリレーションのメソッドです。
            //loadCountでリレーション先の個数もリレーションで取得できる。
            $user = $user->loadCount('get_room_messages');

            return view('users.room', compact('user'));
        }
        return  redirect()->route('users.matches');
    }
    public function store_message(Request $request, User $user)
    {
        //dd( e($request->test));
        $message =  e($request->message);
        //dd($request->owner_id);
        $chat = Chat::create(['message' => $request->message, 'guest_id' => Auth::id(), 'owner_id' => $request->owner_id,'room_id' =>$request->room_id]);
        //->toOthers()を追加することで自分以外にbroadcastできます。
        broadcast(new SendMessage($chat))->toOthers();
        return 'success';
    }
     /**
     * messageを取得
     */
    public function get_messages(User $user,Request $request)
    {
        
        $messages = $user->get_room_messages()->get();
        return $messages;
    }
    /**
     * messageを保存する
     * イベントのブロードキャストを追加
     */
   
}