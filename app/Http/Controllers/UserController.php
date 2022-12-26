<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\FuncCall;

class UserController extends Controller
{
    public function create(Request $request){
       $user = new User();
       return view('usercreate',compact('user'));
    }
    public function insert(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:16|confirmed:password_confirmation',
            'phone' => 'sometimes|min:10|max:10|unique:users',
            'role' => 'required'

        ]);

        $user = new User();
        $user->name = $request->post('name');
        $user->email = $request->post('email');
        $user->password =  Hash::make($request->post('password'));
        $user->address = $request->post('address');
        $user->phone = $request->post('phone');
    
        $user->assignRole($request->post('role'));
        //dd($user);

        $res = $user->save();
    
        //->assignRole($request->post('role'));
        if($res){
            return back()->with('success','New User create successfuly');
        }else{
            return back()->with('fail','Something went wrong');
        }

    }
    public function view(){
        
        return back()->with('fail','Not Implemented yet');
    }
}
