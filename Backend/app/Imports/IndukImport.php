<?php

namespace App\Imports;

use App\Models\Parents;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class IndukImport implements ToModel,WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!isset($row['nomor_sertifikat'])) {
            return null;
        }
        $user = Auth::user()->id;

        return new Parents([
            'auhtor' => $user,
            'address'=> $row['letak_alamat'],
            'item_name'=> $row['nama_barang'],
            'large'=> $row['luas_induk'],
            'certificate_number' => $row['nomor_sertifikat'],
            'certificate_date'=> \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_sertifikat']),
            'asset_value'=> $row['nilai_aset'],
        ]);
    }
}
