<?php

namespace App\Http\Controllers;

use App\Follower;
use App\Like;
use App\Post;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where("id","!=",auth()->user()->id)->get();
        $requests = Follower::with("to_user")->where(["from_user_id"=>auth()->user()->id,"accepted"=>0])->get();
        $active_user = "primary";
        return view('follow_view/users',compact('users','active_user','requests'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //

        $user = User::find(auth()->user()->id);
        return view('auth/user_profile',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //

        $name="";
        if($request->hasfile('filename'))
        {
            $file = $request->file('filename');
            $name = time().$file->getClientOriginalName();
            $file -> move(public_path().'/images/avatar/', $name);
        }

        $user = User::find(auth()->user()->id);
        $user->first_name=$request->get('first_name');
        $user->last_name=$request->get('last_name');
        $user->birth_date=$request->get('birth_date');
        if(strlen($name) > 0)
            $user->avatar = $name;
        $user->save();
        return redirect('user/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function user_info(Request $request)
    {
        $user = User::find($request['id']);
        $posts = Post::where(["user_id" => $request['id']])->limit(3)->get();
        $posts_counts = Post::where(["user_id"=>$request['id']])->count();
        $likes_counts = Like::whereIn('post_id',Post::where(["user_id"=>$request['id']])->get()->pluck('id') )->count();
        $is_follower = Follower::where(["from_user_id"=>auth()->user()->id,"to_user_id"=>$request['id']])->get();

        return view('auth/user_info',compact('user','posts','posts_counts','likes_counts','is_follower'));
    }

    public function autocomplete(Request $request){
        $results = array();
        $item = $request->searchname;
        $data = User::where('first_name','LIKE','%'.$item.'%')->orWhere( 'last_name', 'LIKE', '%'.$item.'%')->take(5)->get();
        return response()->json($data);
    }
}
