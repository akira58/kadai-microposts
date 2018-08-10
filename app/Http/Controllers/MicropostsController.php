<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\User;
use App\Micropost;

class MicropostsController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $microposts = $user->feed_microposts()->orderBy('created_at','desc')->paginate(10);
            
            $data = [
                'user' => $user,
                'microposts' => $microposts,
            ];
            /* $data += $this->counts($user);
              return view('users.show', $data);
            }else{
           */
            return view('welcome', $data);
            }
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:191',
            ]);
            
            $request->user()->microposts()->create(['content' => $request->content,]);
            
            return redirect()->back();
    }
    
    public function destroy($id)
    {
        $micropost = \App\Micropost::find($id);
        
        if (\Auth::id() === $micropost->user_id) {
            $micropost->delete();
        }
        return redirect()->back();
    }
    
    public function favorings($id)
    {
        $user = User::find($id);
        $favorings = $user->favorings()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $favorings,
        ];

        $data += $this->counts($user);

        return view('microposts.favorings', $data);
    }

    public function persons_favor($id)
    {
        $user = User::find($id);
        $persons_favor = $user->persons_favor()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $persons_favor,
        ];

        $data += $this->counts($user);

        return view('microposts.persons_favor', $data);
    }    
}

