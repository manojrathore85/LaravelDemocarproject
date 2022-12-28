<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\FuncCall;
use DataTables;
use Exception;
use Illuminate\Database\Eloquent\Factories\Sequence;
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
                    $btns = '<a href="/useredit/'.$row->id.'" class="btn btn-primary btn-sm">Edit</a>';
                    $btns .= '<a href="userdelete/'.$row->id.'" class="btn btn-danger btn-sm">Delete</a>';
                    return $btns;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        return view('userlist1', compact('roles'));
    }
    public function view(UsersDataTable $dataTable, Request $request){
        // if ($request->ajax()) { dd($request->get('testingparam'));}
          $roles = Role::all()->pluck('name');
          return $dataTable->with([
            'id' => '5',
            'role' => $request->get('role'),
            ])
          ->render('userdatatable', compact('roles'));
        //$dataTable = $dataTable->render('userdatatable');
        //return view('userdatatable')->with($dataTable->render('userdatatable'));

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
            return back()->with('success','New User create successfully');
        }else{
            return back()->with('fail','Something went wrong');
        }

    }
    public function edit($id){
        if(!empty($id)){
           $user = User::find($id);
           return view('usercreate',compact('user'));
        }
    }
    public function update($id, Request $request){
        if(!empty($id)){
           
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$id,              
                'role' => 'required'
            ]);
           $user = User::find($id);
           $user->name = $request->post('name');
           $user->email = $request->post('email');
           $user->address = $request->post('address');
           $user->phone = $request->post('phone');
           $res = $user->save();
           if($res){
                return redirect('userview')->with('success','User updated successfully');
            }else{
                return back()->with('fail','Something went wrong');
            }
           
        }
    }
    public function delete($id)
    {
        if(!empty($id)){
           
            $user = User::find($id);
            try{
            $res = $user->delete();           
            return back()->with('success','User deleted successfully');
           }
           catch(\Exception $e){
            return back()->with('fail','Something went wrong Error:'. $e->getMessage());
           }

        }
    }
    public function create10user(){
        $users = User::factory()
        ->count(10)
        ->make()->each(function($u) {
            $u->assignRole(Role::all()->random());
            return $u->save();
        });
        if($users){
            return redirect('usercreate')->with('success', '10 user Created Successfully');
        }
    }
}
