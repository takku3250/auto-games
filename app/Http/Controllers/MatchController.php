<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Matches; 
use App\Models\User;
use App\Models\Chat;
use Auth;


class MatchController extends Controller
{
  public function index(Matches $matches)
{
    $matches = Matches::all(); // マッチング情報を取得
    return view('matches.index')->with(["matches"=>$matches]);
}
    public function store(User $user,Request $request,Matches $matches)
    
    {
        $owner_id = $request->owner_id;
        $guest_id = Auth::id();
        $post_id=$request->post_id;
        $confirm = Matches::where('post_id',$post_id)->where('guest_id',$guest_id)->where('owner_id',$owner_id)->first();
        if(is_null($confirm)){
        
        $matches->owner_id= $owner_id;
        $matches->guest_id=$guest_id;
        $matches->post_id=$post_id;
        //dd($matches);
        $matches->save();
        }
        else{
            $matches=$confirm;
            //dd($matches);
        }
        
       /* $user=Auth::user();
        $input_owner =  $request->owner_id;
        $input_guests = Auth::id();
        //$user->fill($input_owner)->save();
        $user->matchesAsOwner()->attach($input_owner);
        $owner = User::$input_owner->first();
        
        // マッチングの保存後の処理を追加することもできます

        */return redirect("room/" . $matches->id); // マッチング一覧へのリダイレクトなど
    }
   public function chatroom($id)
 {
  $matches = Matches::find($id);
  $owner =User::find($matches->owner_id);
  
  /*if ($owner->id == Auth::id()){
      //dd(User::find(Auth::id())->guest()->get());
      $matching_result= User::find(Auth::id())->owner()->where('owner_id',Auth::id())->withPivot('id')->get();
      dd($matching_result);
      return view('matching_result')->with(['matching_array' =>$matching_result]);
  } else{
  */
  $messages = Chat::where('room_id',$id)->get();
  return view("rooms.room")->with(['user'=>$owner,'room_id'=>$id,'messages_data'=>$messages]);
 }
 public function match_list()
 {
    $matching_result= User::find(Auth::id())->owner()->where('owner_id',Auth::id())->withPivot('id')->get();
    return view('matching_result')->with(['matching_array' =>$matching_result]);

 }
}