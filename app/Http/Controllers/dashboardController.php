<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\invoicesModel;
use App\Models\productsModel;
use App\Models\employeesModel;
use App\Models\transactionsModel;

class dashboardController extends Controller
{
    public function total_employees(){
        $dataEmployees = employeesModel::with('data_users.role_data')
        ->join('users','users.id_employee','=','employees.id')
        ->join('role','role.id','=','users.id_role')
        ->where('role','=','user')
        ->select('employees.*')
        ->get();
        return response()->json(['data' => $dataEmployees]);
    }

    public function total_products(){
        $dataProducts = productsModel::all();
        return response()->json(['data' => $dataProducts]);
    }

    public function order_today(){
        $productsOrder = invoicesModel::whereDate('created_at',Carbon::today())->get();
        return response()->json(['data' => $productsOrder]);
    }

    public function products_sell_today(){
        $productsSell = transactionsModel::with('product_data:id,kode_produk,nama_produk,harga')->whereDate('created_at',Carbon::today())->get();
        return response()->json(['data' => $productsSell]);
    }

    public function best_selling_products_today(){
        $productsBestSell = transactionsModel::with('product_data:id,nama_produk,gambar,harga')
            ->whereDate('created_at',Carbon::today())
            ->select("id_product", DB::raw("SUM(jumlah_sub_total) as total"))
            ->groupBy("id_product")
            ->orderBy('total', 'desc')
            // ->limit(5)
            ->get();
        return response()->json(['data' => $productsBestSell]);
    }

    public function statistic_revenue_each_month(){
        Carbon::setLocale('id');
        $revenue_each_month = array();
        for ($i = 11; $i >= 0; $i--) {
            $data_each_previous_month = invoicesModel::whereMonth('tanggal_transaksi', Carbon::now()->startOfMonth()->subMonth($i))->get();
            $month_transaction = Carbon::today()->startOfMonth()->subMonth($i)->translatedFormat('F');
            $year_transaction = Carbon::today()->startOfMonth()->subMonth($i)->format('Y');
            if($data_each_previous_month == null){
                array_push($revenue_each_month,array(
                    'bulan' => $month_transaction,
                    'tahun' => $year_transaction,
                    'jumlah' => 0
                ));
            }else{
                array_push($revenue_each_month,array(
                    'bulan' => $month_transaction,
                    'tahun' => $year_transaction,
                    'jumlah' => $data_each_previous_month->sum('total')
                ));
            }
        }

        return response()->json(['data'=>$revenue_each_month]);
    }

    public function statistic_revenue_each_day(){
        Carbon::setLocale('id');
        // $revenue_each_day = array();
        // for ($i = 6; $i >= 0; $i--) {
        //     $data_each_previous_day = invoicesModel::whereDate('tanggal_transaksi', Carbon::now()->subDay($i))->get();
        //     $day_transaction = Carbon::now()->startOfWeek()->subDay($i-2)->translatedFormat('l');
        //     $date_transaction = Carbon::now()->startOfWeek()->subDay($i-2)->format('d-m-Y');
        //     if($data_each_previous_day == null){
        //         array_push($revenue_each_day,array(
        //             'hari' => $day_transaction,
        //             'tanggal' => $date_transaction,
        //             'jumlah' => 0
        //         ));
        //     }else{
        //         array_push($revenue_each_day,array(
        //             'hari' => $day_transaction,
        //             'tanggal' => $date_transaction,
        //             'jumlah' => $data_each_previous_day->sum('total')));
        //     }
        // }

        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        $revenue_each_day = array();
        for($i = 0; $i >= -6; $i--){
            $data_each_previous_day = invoicesModel::where('tanggal_transaksi', '=' ,Carbon::now()->startOfWeek()->subDay($i)->format('Y-m-d'))->get();
            $date_transaction = Carbon::now()->startOfWeek()->subDay($i)->format('d-m-Y');
            $day_transaction = Carbon::now()->startOfWeek()->subDay($i)->translatedFormat('l');
            if($data_each_previous_day == null){
                array_push($revenue_each_day,array(
                    'hari' => $day_transaction,
                    'tanggal' => $date_transaction,
                    'jumlah' => 0
                ));
            }else{
                array_push($revenue_each_day,array(
                    'hari' => $day_transaction,
                    'tanggal' => $date_transaction,
                    'jumlah' => $data_each_previous_day->sum('total')
                ));
            }
        }

        return response()->json(['data'=>$revenue_each_day]);
    }
}
