import { useState, useEffect } from "react";
import { DashboardTableRow } from "../../components/Dashboard/DashboardTableRow";
import LayoutAdmin from "../../components/Layout/layoutAdmin";

import { ExportExcel } from "../../components/ExportExcel";

export const DashboardAdmin = () => {

    const apiUrl = process.env.REACT_APP_API_URL;

    const formatter = new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
    });

    const [dashboardData, setDashboardData] = useState([]);
    const [exportData, setExportData] = useState([]);
    const [total, setTotal] = useState({
        total_tanah_induk: 0,
        total_tanah_pinjam_pakai: 0,
        total_tanah_pakai_sendiri: 0,
        total_tanah_sewa_sip_bmd: 0,
        total_rupiah_tanah_sewa_sip_bmd: 0,
        total_tanah_retribusi: 0,
        total_rupiah_tanah_retribusi: 0
    });
    const [filterYear, setFilterYear] = useState('2022');
    const [emptyMsg, setEmptyMsg] = useState("");

    useEffect(() => {
        const fetchData = async () => {
            let token = localStorage.getItem("token");

            try {
                let res = await fetch(apiUrl + "dashboard/all/" + filterYear, {
                    method: "GET",
                    headers: {
                        "Content-type": "application/json; charset=UTF-8",
                        Authorization: "Bearer " + token,
                    },
                });

                let resJson = await res.json();

                if (res.status !== 200) {
                    return console.log(resJson.message);
                }

                let resData = resJson.data;

                if (resData.length === 0) {
                    return setEmptyMsg("Tidak ada data.");
                }

                setEmptyMsg("");

                let totalTanahInduk = 0;
                let tanahPinjamPakai = 0;
                let tanahPakaiSendiri = 0;
                let tanahSewaSipBmd = 0;
                let rupiahTanahSewaSipBms = 0;
                let tanahRetribusi = 0;
                let rupiahTanahRetribusi = 0;

                // Set dashboard total
                resData.forEach((item, key) => {
                    totalTanahInduk += item.total_tanah_induk;
                    tanahPinjamPakai += item.total_tanah_pinjam_pakai;
                    tanahPakaiSendiri += item.total_tanah_pakai_sendiri;
                    tanahSewaSipBmd += item.total_tanah_sewa_sip_bmd;
                    rupiahTanahSewaSipBms += item.total_rupiah_tanah_sewa_sip_bmd;
                    tanahRetribusi += item.total_tanah_retribusi;
                    rupiahTanahRetribusi += item.total_rupiah_tanah_retribusi;
                });

                setTotal({
                    total_tanah_induk: totalTanahInduk,
                    total_tanah_pinjam_pakai: tanahPinjamPakai,
                    total_tanah_pakai_sendiri: tanahPakaiSendiri,
                    total_tanah_sewa_sip_bmd: tanahSewaSipBmd,
                    total_rupiah_tanah_sewa_sip_bmd: rupiahTanahSewaSipBms,
                    total_tanah_retribusi: tanahRetribusi,
                    total_rupiah_tanah_retribusi: rupiahTanahRetribusi
                });

                setDashboardData(resData);
            } catch (error) {
                console.log(error);
            }
        };

        const getExportData = async () => {
            let token = localStorage.getItem("token");

            try {
                let res = await fetch(apiUrl + "export/all/data/upt", {
                    method: "GET",
                    headers: {
                        "Content-type": "application/json; charset=UTF-8",
                        Authorization: "Bearer " + token,
                    }
                });

                let resJson = await res.json();

                if (res.status !== 200) {
                    return console.log(resJson.message);
                }

                setExportData(resJson.data);

            } catch (error) {
                console.log(error);
            }
        };

        fetchData().catch(console.error);
        getExportData().catch(console.error);
    }, [filterYear]); // eslint-disable-line react-hooks/exhaustive-deps


    return (
        <LayoutAdmin>
            <div className="d-flex justify-content-between px-3 py-3">
                <select
                    value={filterYear}
                    onChange={(e) => {
                        setFilterYear(e.target.value);
                    }}
                    className="h-100 rounded text-cyanblue px-3 py-1 font-semibold bg-white border-cyanblue"
                >
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                    <option value="2019">2019</option>
                </select>
                <div className="d-flex gap-2 align-items-center">
                    <ExportExcel excelData={exportData} fileName="Semua Data UPT" />
                    {/* <div onClick={() => exportData()} className="bg-cyanblue px-3 py-1 font-semibold text-white rounded primary-btn">
                        EXPORT DATA
                    </div> */}
                </div>
            </div>

            {/* table */}
            <div className="dashboard-table mx-3 p-2 pb-0 border-cyanblue bg-white">
                <div className="d-flex justify-content-between py-2 px-2">
                    <h5 className="font-semibold">Informasi Total Data UPT</h5>
                </div>
                <div className="">
                    <div className="row row-header">
                        <div className="col d-flex align-items-center justify-content-center">
                            NAMA UPT
                        </div>
                        <div className="col d-flex align-items-center justify-content-center">
                            Jumlah Bidang Tanah
                        </div>
                        <div className="col d-flex flex-col align-items-center justify-content-center">
                            TOTAL PINJAM PAKAI
                            <br />
                        </div>
                        <div className="col d-flex flex-col align-items-center justify-content-center">
                            TOTAL PAKAI SENDIRI
                            <br />
                        </div>
                        <div className="col d-flex flex-col align-items-center justify-content-center">
                            TOTAL SEWA/SIP BMD
                            <br />
                            <div className="row py-2">
                                <div className="col">TANAH(M)</div>
                                <div className="col">RUPIAH</div>
                            </div>
                        </div>
                        <div className="col d-flex flex-col align-items-center justify-content-center py-2">
                            TOTAL RETRIBUSI
                            <br />
                            <div className="row py-2">
                                <div className="col">TANAH(M)</div>
                                <div className="col">RUPIAH</div>
                            </div>
                        </div>
                    </div>
                    {emptyMsg === "" ? (
                        <>
                            {dashboardData.map((item) => {
                                return <DashboardTableRow key={item.id} title={item.name} dashboardItem={item} />;
                            })}
                        </>
                    ) : (
                        <>
                            <div class="text-center">{emptyMsg}</div>
                        </>
                    )}
                </div>
                <div
                    className="row row-content col-footer border-none"
                    style={{
                        background: "#EDF9FB",
                    }}
                >
                    <div className="col d-flex align-items-center justify-content-center">
                        TOTAL KESELURUHAN
                    </div>
                    <div className="col d-flex align-items-center justify-content-center">
                        {total.total_tanah_induk}
                    </div>
                    <div className="col d-flex flex-col align-items-center justify-content-center">
                        <div className="row py-2">
                            <div className="col">{total.total_tanah_pinjam_pakai}</div>
                        </div>
                    </div>
                    <div className="col d-flex flex-col align-items-center justify-content-center">
                        <div className="row py-2">
                            <div className="col">{total.total_tanah_pakai_sendiri}</div>
                        </div>
                    </div>
                    <div className="col d-flex flex-col align-items-center justify-content-center">
                        <div className="row py-2">
                            <div className="col">{total.total_tanah_sewa_sip_bmd}</div>
                            <div className="col">{formatter.format(total.total_rupiah_tanah_sewa_sip_bmd)}</div>
                        </div>
                    </div>
                    <div className="col d-flex flex-col align-items-center justify-content-center">
                        <div className="row py-2">
                            <div className="col">{total.total_tanah_retribusi}</div>
                            <div className="col">{formatter.format(total.total_rupiah_tanah_retribusi)}</div>
                        </div>
                    </div>
                </div>
            </div>
        </LayoutAdmin>
    );
};
