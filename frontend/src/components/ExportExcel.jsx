import React from 'react'
import * as FileSaver from 'file-saver';
import * as XLSX from 'xlsx';

import Swal from 'sweetalert2';

export const ExportExcel = ({ excelData, fileName }) => {

    const fileType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=UTF-8';
    const fileExtension = '.xlsx';

    const exportToExcel = (excelData, fileName) => {
        const ws = XLSX.utils.json_to_sheet(excelData);
        const wb = { Sheets: { 'data': ws }, SheetNames: ['data'] };
        const excelBuffer = XLSX.write(wb, { bookType: 'xlsx', type: 'array' });
        const data = new Blob([excelBuffer], { type: fileType });

        Swal.fire({
            title: 'Mengekspor data...',
            text: 'Harap tunggu...',
            allowOutsideClick: false,
            onBeforeOpen: () => {
                Swal.showLoading()
            }
        })

        FileSaver.saveAs(data, fileName + fileExtension);

        Swal.fire({
            title: 'Berhasil!',
            text: `Data ${fileName} berhasil di export.`,
            icon: 'success',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false
        })
    }

    return (
        <div className='bg-cyanblue px-3 py-1 font-semibold text-white rounded primary-btn' onClick={(e) => exportToExcel(excelData, fileName)}>EXPORT DATA</div>
    )
}