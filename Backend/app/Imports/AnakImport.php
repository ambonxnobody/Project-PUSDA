<?php

namespace App\Imports;

use App\Models\Childer;
use App\Models\Parents;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class AnakImport implements ToModel,WithHeadingRow
{
    use Importable;

    protected $parent;

    public function __construct($id)
    {
        //QUERY UNTUK MENGAMBIL SELURUH DATA USER
        $this->id = $id;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!isset($row['jenis_pemanfaatan'])) {
            return null;
        }

        $induk = Parents::where('id',$this->id)->first();
        return new Childer([
            'parent_id' => $induk->id ?? NULL,
            'utilization_engagement_type' => $row['jenis_pemanfaatan'],
            'utilization_engagement_name' => $row['nama_pemanfaatan'],
            'allotment_of_use'  => $row['peruntukan_penggunaan'],
            'large'  => $row['luas'],
            'rental_retribution' => $row['nilai_sewa_retribusi'],
            'validity_period_of'  => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['masa_berlaku_dari']),
            'validity_period_until'  => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['masa_berlaku_sampai']),
            'engagement_date'  => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_perikatan']),
            'engagement_number'  => $row['nomor_perikatan'],
            'coordinate'  => $row['koordinat'],
            'present_condition'  => $row['kondisi_sekarang'] ?? NULL,
            'description'  => $row['keterangan'],
            'application_letter'=> 'null',
            'agreement_letter'=> 'null'
        ]);
    }
}
