<?php

namespace App\Exports;

use App\Models\Childer;
use App\Models\Parents;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPerUpt implements FromCollection, WithMapping, WithHeadings
{


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $induk = Parents::where('auhtor',Auth::user()->roles()->pluck('id'))->get();

        foreach($induk as $inc){

            $anak =  Childer::with('parent','payments')
                            ->where('parent_id',$inc->id )
                            ->get();
        }

        return $anak;
    }

    public function map($invoice): array
    {
        return [
            $invoice->parent->auhtor = Auth::user()->name,
            $invoice->parent->certificate_number,
            $invoice->parent->certificate_date,
            $invoice->parent->address,
            $invoice->parent->large,
            $invoice->parent->asset_value,

            $invoice->utilization_engagement_type,
            $invoice->utilization_engagement_name,
            $invoice->rental_retribution,
            $invoice->allotment_of_use,
            $invoice->coordinate,
            $invoice->large,
            $invoice->present_condition,
            $invoice->validity_period_of,
            $invoice->validity_period_until,
            $invoice->engagement_number,
            $invoice->engagement_date,
            $invoice->description,

            $invoice->payments()->pluck('year'),
            $invoice->payments()->pluck('payment_amount'),

        ];
    }

    public function headings(): array
    {
        return [
            'Nama Author',
            'Nomor Sertifikat',
            'Tanggal Sertifikat',
            'Alamat',
            'Luas',
            'Nilai Aset',

            'Jenis Pemanfaatan',
            'Nama Penggunaan',
            'Sewa Retribusi',
            'Peruntukan Penggunaan',
            'koordinat',
            'Luas',
            'Kondisi Sekarang',
            'Masa Berlaku Dari',
            'Masa Berlaku Sampai',
            'Nomor Perikatan',
            'Tanggal Perikatan',
            'keterangan',

            'Tahun',
            'Jumlah Pembayaran',
        ];
    }
}
