<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\sales;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        //return $dataTable->render('userlist');
        $merchants = User::role('merchant')->get();
        if ($request->ajax()) {
                    
            $query = DB::table('sales')
                ->join('users', 'users.id', '=', 'sales.user_id')
                ->join('cars', 'cars.id', '=', 'sales.car_id')
                ->select('sales.*', 'users.name as customername', 'cars.name as carname');

            if (!empty($request->get('merchant'))) {
                $query = $query->where('create_by', $request->get('merchant'));
            }
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btns = '<a href="/salesedit/'.$row->id.'" class="btn btn-primary btn-sm">Edit</a>';
                    $btns .= '<a href="salesdelete/'.$row->id.'" class="btn btn-danger btn-sm">Delete</a>';
                    return $btns;
                })               
                ->make(true);
        }

        return view('saleslist', compact('merchants'));
    }

    public function manage($id = '')
    {
        $sales = $id ? sales::find($id): false;
        $users =  User::role('customer')->get();
        $cars = Car::all();
        return view('salescreate', compact('users', 'cars', 'sales'));
    }
    public function store(Request $request, $id = '')
    {
        $request->validate([
            'sale_date' => 'required',
            'user_id' => 'required',
            'car_id' => 'required'

        ]);
        //  dd($request);
        $sales = new sales();
        $params = $request->except(['_token']);
        $params['create_by'] =  Auth::id();
        if($id){
           $res = sales::find($id)->update($params);
        }else{
            // dd($params);
            
            $res = $sales->create($params);
        }
        if ($res) {
            return back()->with('success', 'Record Store successfuly');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }
}
