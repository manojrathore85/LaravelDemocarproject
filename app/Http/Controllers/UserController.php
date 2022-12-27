<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\FuncCall;
use DataTables;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //return $dataTable->render('userlist');
        $roles = Role::all()->pluck('name');
        if ($request->ajax()) {
            if(!empty($request->get('role'))){
                $data = User::role($request->get('role'))->get();
            }else{
                $data = User::all();
            }
           
                   return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        return view('userlist1', compact('roles'));
    }
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
