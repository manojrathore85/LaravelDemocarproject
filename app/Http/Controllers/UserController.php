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
    public function manage(Request $request, $id = ''){
       $user = $id ? User::find($id) : false;
       $user_role = $user ? $user->getRoleNames()[0] : '';
       $roles = Role::all()->pluck('name');
       return view('usercreate',compact('user','roles','user_role'));
    }
    public function store(Request $request, $id = ''){
       $varray = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$id,
        'phone' => 'sometimes|min:10|max:10|unique:users,phone,'.$id,
        'role' => 'required',
       ];
       if(!$id){
        $varray[ 'password'] =  'required|min:8|max:16|confirmed:password_confirmation';
       }
        $request->validate($varray);       
       $params = $request->except(['_token', 'role']);      
        if($id){          
            $user = User::find($id);
          
            $user->syncRoles($request->post('role'));
           $res = $user->update($params);
        }
        else {
            $params['password'] = Hash::make($request->password);
            $user = new User(); 
            $res = $user->create($params);
            $res->assignRole($request->role);
        }   
        //->assignRole($request->post('role'));
        if($res){
            return back()->with('success','Record Store successfully');
        }else{
            return back()->with('fail','Something went wrong');
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
