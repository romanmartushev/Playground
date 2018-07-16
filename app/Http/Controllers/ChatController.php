<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    protected $chat_dir = '/public/chat/chat.json';

    public function index()
    {
        if(Storage::disk('local')->exists($this->chat_dir)){
            $now   = time();
            $time = Storage::lastModified($this->chat_dir);
            if($now - $time >= 60 * 60 * 24){ // 2 days
                Storage::disk('local')->delete($this->chat_dir);
            }
        }
        return view('/chat/index');
    }

    public function addMessage(Request $request)
    {
        $message = $request->input('message');
        $user = $request->input('user');
        $image = $request->input('image');
        $image_ext = $request->input('text');
        $time = $request->input('time');

        $image .= '&text='.$image_ext;

        $data = [
          'message' => $message,
          'user'    => $user,
          'image'   => $image,
          'time'    => $time
        ];

        if(Storage::disk('local')->exists($this->chat_dir)){
            $json = Storage::get($this->chat_dir);
            $old_data = json_decode($json);
            $data = json_decode(json_encode($data));
            array_push($old_data,$data);
            Storage::put($this->chat_dir,json_encode($old_data));
        }
        else{
            Storage::put($this->chat_dir,json_encode([$data]));
        }
        return ['success' => 'message added!!'];
    }

    public function newMessages()
    {
        if(Storage::disk('local')->exists($this->chat_dir)){
            $content = Storage::get($this->chat_dir);
            return json_decode($content);
        }
        return [];
    }
}
