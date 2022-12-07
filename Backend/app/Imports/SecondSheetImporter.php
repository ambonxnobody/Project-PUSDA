<?php

namespace App\Imports;

use App\Models\Childer;
use App\Models\Parents;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class SecondSheetImporter implements ToModel,WithHeadingRow
{
    use Importable;

    protected $parent;
    public function __construct()
    {
        //QUERY UNTUK MENGAMBIL SELURUH DATA USER
        $this->parent = Parents::select('id')->get();
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!isset($row['sewa_retribusi'])) {
            return null;
        }


        $induk = DB::table('parents')->select('id')->first();

        return new Childer([
            'parent_id' => $induk->id ?? NULL,
            'rental_retribution' => $row['sewa_retribusi'],
            'utilization_engagement_type' => $row['jenis_pemanfaatan'],
            'utilization_engagement_name' => $row['nama_pemanfaatan'],
            'allotment_of_use'  => $row['peruntukan_penggunaan'],
            'coordinate'  => $row['koordinat'],
            'large'  => $row['luas'],
            'present_condition'  => $row['kondisi_sekarang'],
            'assets_value'  => $row['nilai_aset'],
            'validity_period_of'  => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['masa_berlaku']),
            'validity_period_until'  => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['masa_berlaku_sampai']),
            'engagement_number'  => $row['nomor_perikatan'],
            'engagement_date'  => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_perikatan']),
            'description'  => $row['keterangan'],
            'year' => $row['tahun'],
            'payment_amount' => $row['jumlah_pembayaran'],
            'proof_of_payment' => 'null',
            'application_letter'=> 'null',
            'agreement_letter'=> 'null'
        ]);
    }
}
