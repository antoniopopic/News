<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Image;
use File;
use Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        return view('profile', compact('user'));
    }

    public function avatar(Request $request)
    {

        request()->validate([
            'avatar' => 'image|nullable|max:2043|mimes:jpeg, png, jpg, gif',
        ]);

        $user = User::find(Auth::user()->id);

        if($request->hasFile('avatar')){
            $avatar=$request->file('avatar');
            $filename = time(). '.' . $avatar->getClientOriginalExtension();
            // Delete current image before uploading new image
            if ($user->avatar !== 'default.jpg') {
                $file = public_path('uploads/avatars/' . $user->avatar);

                if (File::exists($file)) {
                    unlink($file);
                }

            }
            Image::make($avatar)->resize(300,300)->save(public_path('/uploads/avatars/'.$filename));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        return view('profile', compact('user'));
    }

    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with('error', 'Your current password does not match with the password you provided. Please try again.');
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with('error', 'New Password cannot be same as your current password. Please choose a different password.');
        }

        $request = request()->validate([
            'current-password' => 'required',
            'new-password' => 'required|min:8|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = request('new-password');
        $user->save();
        return redirect()->back()->with('success', 'Password changed successfully !');
        /* return redirect(route('changePassword'))->with('success', 'Password changed successfully!'); */

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        request()->user()->authorizeRoles(['admin', 'editor']);

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'username'  => 'required|min:3|max:255|unique:users',
            'email'     => 'required|email|max:255|unique:users',
            'password'  => 'required|confirmed|min:8'
        ]);

        User::create(request(['username', 'email', 'password']));

        return redirect()->route('users.index')->with('status', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        request()->validate([
            'username'  => 'required|min:3|max:255|unique:users,username,'.$user->id,
            'email'     => 'required|email|max:255|unique:users,email,'.$user->id,
            'password'  => 'nullable|confirmed|min:6'
        ]);

        $user->update(request(['username', 'email', 'password']));

        return redirect()->route('users.index')->with('status', 'User ' . $user->username . ' is successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('status', 'User is successfully deleted');
    }
}
