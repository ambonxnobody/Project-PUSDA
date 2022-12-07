<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Parents;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;


class DashboardController extends Controller
{
    public function get(Request $request, $year)
    {
        $auhthor = Auth::user();
        $query =  DB::table('parents')
            ->where('auhtor', '=', Auth::user()->id)
            ->whereYear('certificate_date', '=', $year);

        $total_tanah = $query->count();

        $total_tanah_pinjam_pakai = DB::table('parents')
            ->join('childers', function ($join) {
                $join->on('childers.parent_id', '=', 'parents.id');
            })
            ->where('auhtor', '=', Auth::user()->id)
            ->whereYear('certificate_date', '=', $year)
            ->where('utilization_engagement_type', '=', 'pinjam_pakai')
            ->count();

        $total_tanah_pakai_sendiri = DB::table('parents')
            ->join('childers', function ($join) {
                $join->on('childers.parent_id', '=', 'parents.id');
            })
            ->where('auhtor', '=', Auth::user()->id)
            ->whereYear('certificate_date', '=', $year)
            ->where('utilization_engagement_type', '=', 'pakai_sendiri')
            ->count();

        $total_tanah_retribusi_query = DB::table('parents')
            ->join('childers', function ($join) {
                $join->on('childers.parent_id', '=', 'parents.id');
            })
            // ->join('payments', function ($join) {
            //     $join->on('childers.id', '=', 'payments.childrens_id');
            // })
            ->where('auhtor', '=', Auth::user()->id)
            ->where('utilization_engagement_type', '=', 'retribusi')
            ->whereYear('certificate_date', '=', $year)
            // ->where('year', '=', $year)
            ->count();

        $total_rupiah_retribusi_query = DB::table('parents')
            ->join('childers', function ($join) {
                $join->on('childers.parent_id', '=', 'parents.id');
            })
            ->join('payments', function ($join) {
                $join->on('childers.id', '=', 'payments.childrens_id');
            })
            ->where('auhtor', '=', Auth::user()->id)
            ->where('utilization_engagement_type', '=', 'retribusi')
            ->where('year', '=', $year)
            ->sum('payment_amount');

        $total_tanah_sewa_query = DB::table('parents')
            ->join('childers', function ($join) {
                $join->on('childers.parent_id', '=', 'parents.id');
            })
            // ->join('payments', function ($join) {
            //     $join->on('childers.id', '=', 'payments.childrens_id');
            // })
            ->where('auhtor', '=', Auth::user()->id)
            ->where('utilization_engagement_type', '=', 'sewa_sip_bmd')
            ->whereYear('certificate_date', '=', $year)
            // ->where('year', '=', $year)
            ->count();

        $total_rupiah_sewa_query = DB::table('parents')
            ->join('childers', function ($join) {
                $join->on('childers.parent_id', '=', 'parents.id');
            })
            ->join('payments', function ($join) {
                $join->on('childers.id', '=', 'payments.childrens_id');
            })
            ->where('auhtor', '=', Auth::user()->id)
            ->where('utilization_engagement_type', '=', 'sewa_sip_bmd')
            ->where('year', '=', $year)
            ->sum('payment_amount');


        return response()->json([
            'success' => true,
            'message' => 'Sukses',
            'data' => [
                [
                    'auhtor' => $auhthor,
                    "total_tanah_induk" => $total_tanah,
                    "total_tanah_pinjam_pakai" => $total_tanah_pinjam_pakai,
                    "total_tanah_pakai_sendiri" => $total_tanah_pakai_sendiri,
                    "total_tanah_retribusi" => $total_tanah_retribusi_query,
                    'total_rupiah_tanah_retribusi' => $total_rupiah_retribusi_query,
                    "total_tanah_sewa_sip_bmd" => $total_tanah_sewa_query,
                    'total_rupiah_tanah_sewa_sip_bmd' => $total_rupiah_sewa_query,
                ]
            ]
        ]);
    }

    public function getAll(Request $request, $year)
    {
        $data = User::withCount(['parents as total_tanah_induk' => function (Builder $query) use ($year) {
            $query->whereYear('certificate_date', $year);
        }, 'childers as total_tanah_pinjam_pakai' => function (Builder $query) use ($year) {
            $query->whereYear('certificate_date', '=', $year)->where('utilization_engagement_type', 'pinjam_pakai');
        }, 'childers as total_tanah_pakai_sendiri' => function (Builder $query) use ($year) {
            $query->whereYear('certificate_date', '=', $year)->where('utilization_engagement_type', 'pakai_sendiri');
        }, 'childers as total_tanah_sewa_sip_bmd' => function (Builder $query) use ($year) {
            $query->whereYear('engagement_date', '=', $year)->where('utilization_engagement_type', 'sewa_sip_bmd');
        }, 'childers as total_tanah_retribusi' => function (Builder $query) use ($year) {
            $query->whereYear('engagement_date', '=', $year)->where('utilization_engagement_type', 'retribusi');
        }, 'payments as total_rupiah_tanah_sewa_sip_bmd' => function ($query) use ($year) {
            $query->where('utilization_engagement_type', '=', 'sewa_sip_bmd')->where('payments.year', '=', $year)->select(DB::raw('sum(payment_amount)'));
        }, 'payments as total_rupiah_tanah_retribusi' => function ($query) use ($year) {
            $query->where('utilization_engagement_type', '=', 'retribusi')->where('payments.year', '=', $year)->select(DB::raw('sum(payment_amount)'));
        },])
            ->get();


        $total_tanah = Parents::whereYear('certificate_date', '=', $year)->count();

        $total_tanah_pinjam_pakai = DB::table('parents')
            ->join('childers', function ($join) {
                $join->on('childers.parent_id', '=', 'parents.id');
            })
            ->whereYear('certificate_date', '=', $year)
            ->where('utilization_engagement_type', '=', 'pinjam_pakai')
            ->count();

        $total_tanah_pakai_sendiri = DB::table('parents')
            ->join('childers', function ($join) {
                $join->on('childers.parent_id', '=', 'parents.id');
            })
            ->whereYear('certificate_date', '=', $year)
            ->where('utilization_engagement_type', '=', 'pakai_sendiri')
            ->count();

        $total_tanah_retribusi = DB::table('parents')
            ->join('childers', function ($join) {
                $join->on('childers.parent_id', '=', 'parents.id');
            })
            // ->join('payments', function ($join) {
            //     $join->on('childers.id', '=', 'payments.childrens_id');
            // })
            ->where('utilization_engagement_type', '=', 'retribusi')
            ->whereYear('engagement_date', '=', $year)
            ->count();

        $total_rupiah_retribusi = DB::table('parents')
            ->join('childers', function ($join) {
                $join->on('childers.parent_id', '=', 'parents.id');
            })
            ->join('payments', function ($join) {
                $join->on('childers.id', '=', 'payments.childrens_id');
            })
            ->where('utilization_engagement_type', '=', 'retribusi')
            ->where('year', '=', $year)
            ->sum('payment_amount');

        $total_tanah_sewa = DB::table('parents')
            ->join('childers', function ($join) {
                $join->on('childers.parent_id', '=', 'parents.id');
            })
            // ->join('payments', function ($join) {
            //     $join->on('childers.id', '=', 'payments.childrens_id');
            // })
            ->where('utilization_engagement_type', '=', 'sewa_sip_bmd')
            ->whereYear('engagement_date', '=', $year)
            ->count();

        $total_rupiah_sewa = DB::table('parents')
            ->join('childers', function ($join) {
                $join->on('childers.parent_id', '=', 'parents.id');
            })
            ->join('payments', function ($join) {
                $join->on('childers.id', '=', 'payments.childrens_id');
            })
            ->where('utilization_engagement_type', '=', 'sewa_sip_bmd')
            ->where('year', '=', $year)
            ->sum('payment_amount');


        return response()->json([
            'success' => true,
            'message' => 'Berhasil',
            'data' => $data,
            "keseluruhan" => [
                [
                    "total_tanah" => $total_tanah,
                    "total_tanah_pinjam_pakai" => $total_tanah_pinjam_pakai,
                    "total_tanah_pakai_sendiri" => $total_tanah_pakai_sendiri,
                    "total_tanah_retribusi" => $total_tanah_retribusi,
                    "total_rupiah_retribusi" => $total_rupiah_retribusi,
                    "total_tanah_sewa" => $total_tanah_sewa,
                    "total_rupiah_sewa" => $total_rupiah_sewa
                ]
            ]
        ]);
    }
}
