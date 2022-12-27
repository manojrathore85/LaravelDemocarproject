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
                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('saleslist', compact('merchants'));
    }

    public function create()
    {
        $users =  User::role('customer')->get();
        $cars = Car::all();
        return view('salescreate', compact('users', 'cars'));
    }
    public function insert(Request $request)
    {
        $request->validate([
            'sale_date' => 'required',
            'user_id' => 'required',
            'car_id' => 'required'

        ]);
        //  dd($request);
        $sales = new sales();
        $sales->sale_date =  $request->post('sale_date');
        $sales->user_id = $request->post('user_id');
        $sales->car_id = $request->post('car_id');
        $sales->create_by = Auth::id();
        $res = $sales->save();

        //->assignRole($request->post('role'));
        if ($res) {
            return back()->with('success', 'New Sales create successfuly');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }
}
