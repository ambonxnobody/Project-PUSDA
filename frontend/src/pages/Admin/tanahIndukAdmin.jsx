import { useState, useEffect } from "react";
import { Link, useParams } from "react-router-dom";
import LayoutAdmin from "../../components/Layout/layoutAdmin";
import { DeleteConfirmation } from "../../components/UPTDashboard/DeleteConfirmation";
import { IndukTableRowAdmin } from "../../components/UPTDashboard/IndukTableRowAdmin";
import ReactPaginate from "react-paginate";

import Swal from "sweetalert2";

export const TanahIndukAdmin = () => {
    const apiUrl = process.env.REACT_APP_API_URL;

    const [openEditTanah, setOpenEditTanah] = useState(false);
    const [show, setShow] = useState(false);
    const params = useParams();
    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);

    //format date into yyyy-mm-dd with leading zero
    const formatDate = (date) => {
        const d = new Date(date);
        const month = `${d.getMonth() + 1}`.padStart(2, "0");
        const day = `${d.getDate()}`.padStart(2, "0");
        const year = d.getFullYear();
        return [year, month, day].join("-");
    };

    const handlePageClick = (e) => {
        if (e.selected >= 0) {
            setPageNum(e.selected + 1);
        }
    };

    const [data, setData] = useState([]);
    const [pageNum, setPageNum] = useState(1);
    const [pageCount, setPageCount] = useState(0);
    const [startingPoint, setStartingPoint] = useState(0);
    const [search, setSearch] = useState("");
    const [urlDelete, setUrlDelete] = useState("");
    const [triggerDeleted, setTriggerDeleted] = useState(false);
    const [emptyMsg, setEmptyMsg] = useState("");

    const [formData, setFormData] = useState({
        sertifikatNomor: "",
        hakPakaiTanggal: "",
        namaJenisBarang: "",
        nilaiAset: "",
        alamat: "",
        luas: "",
    });

    useEffect(() => {
        const fetchData = async () => {
            let token = localStorage.getItem("token");
            let authorId = localStorage.getItem("active_author_id");

            try {
                let res = await fetch(
                    apiUrl +
                    "parent/all?page=" +
                    pageNum +
                    "&auhtor=" +
                    authorId +
                    "&keyword=" +
                    search,
                    {
                        method: "GET",
                        headers: {
                            "Content-type": "application/json; charset=UTF-8",
                            Authorization: "Bearer " + token,
                        },
                    }
                );

                let resJson = await res.json();

                if (res.status != 200) {
                    return console.log(resJson.message);
                }

                // Check if result is from search
                if (Array.isArray(resJson.data)) {
                    setPageCount(1);
                    setStartingPoint(1);
                } else {
                    setPageCount(resJson.data.last_page);
                    setStartingPoint(
                        resJson.data.per_page * resJson.data.current_page -
                        (resJson.data.per_page - 1)
                    );
                }

                let resData = Array.isArray(resJson.data)
                    ? resJson.data
                    : resJson.data.data;
                if (resData.length == 0) {
                    return setEmptyMsg("Tidak ada data.");
                }

                setEmptyMsg("");
                setData(resData);
            } catch (error) {
                console.log(error);
            }
        };

        fetchData().catch(console.error);
    }, [params.id, triggerDeleted, pageNum, search]); // eslint-disable-line react-hooks/exhaustive-deps

    const toggleEditTanah = () => {
        if (openEditTanah) {
            // setNavbarInfo("")
            setOpenEditTanah(false);
        } else {
            // setNavbarInfo("/Tambah Total Tanah")
            setOpenEditTanah(true);
        }
    };

    const importDataTanahInduk = () => {
        Swal.fire({
            title: "Import Data",
            text: "Upload file excel",
            input: "file",
            inputAttributes: {
                accept: ".xls,.xlsx,.csv, .xlx",
                "aria-label": "Upload your file",
                name: "file",
            },
            showCancelButton: true,
            confirmButtonText: "Upload",
            showLoaderOnConfirm: true,
            preConfirm: (file) => {
                let token = localStorage.getItem("token");
                let formData = new FormData();
                formData.append("file", file);
                formData.append("token", token);

                return fetch(apiUrl + "import/file/parent", {
                    method: "POST",
                    body: formData,
                }).then((response) => {
                    if (!response.ok) {
                        throw new Error(response.statusText);
                    }
                    return response.json();
                }).catch((error) => {
                    Swal.showValidationMessage(`Request failed: ${error}`);
                });
            },
            allowOutsideClick: () => !Swal.isLoading(),
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Success!",
                    text: "Data berhasil diimport",
                    icon: "success",
                });

                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                Swal.fire({
                    title: "Error!",
                    text: "Data gagal diimport",
                    icon: "error",
                });
            }
        });
    };

    return (
        <LayoutAdmin>
            {!openEditTanah ? (
                <>
                    <div className="d-flex flex-row justify-content-between px-3 py-3">
                        <div
                            onClick={importDataTanahInduk}
                            className="secondary-btn d-flex align-items-center"
                            style={{ padding: "0 15px" }}
                        >
                            Import
                        </div>
                        <div className="d-flex">
                            <input
                                className="form-control me-2 bg-none"
                                style={{ width: "200px" }}
                                type="search"
                                placeholder="Search"
                                aria-label="Search"
                                value={search}
                                onChange={(e) => setSearch(e.target.value)}
                            ></input>
                            <Link
                                to={"/upt/" + params.id + "/admin/tambah-induk"}
                                className="primary-btn d-flex justify-content-center align-items-center"
                            >
                                Tambah Tanah
                            </Link>
                        </div>
                    </div>

                    <div className="upt-dashboard-table">
                        <div className="row m-0">
                            {emptyMsg == "" ? (
                                <>
                                    {data.map((item, key) => {
                                        return (
                                            <IndukTableRowAdmin
                                                iterator={startingPoint + key}
                                                upt={params.id}
                                                key={item.id}
                                                id={item.id}
                                                sertifikatNomor={
                                                    item.certificate_number
                                                }
                                                hakPakaiTanggal={
                                                    item.certificate_date
                                                }
                                                namaJenisBarang={item.item_name}
                                                nilaiAset={item.asset_value}
                                                alamat={item.address}
                                                luas={item.large}
                                                handleShow={handleShow}
                                                toggleTambahTanah={
                                                    toggleEditTanah
                                                }
                                                setFormData={setFormData}
                                                urlDeleteStateChanger={
                                                    setUrlDelete
                                                }
                                            />
                                        );
                                    })}
                                </>
                            ) : (
                                <>
                                    <div class="text-center">{emptyMsg}</div>
                                </>
                            )}
                        </div>

                        <div className="pagination-container">
                            <ReactPaginate
                                nextLabel="next >"
                                onPageChange={handlePageClick}
                                pageRangeDisplayed={3}
                                marginPagesDisplayed={2}
                                pageCount={pageCount}
                                previousLabel="< previous"
                                pageClassName="page-item"
                                pageLinkClassName="page-link"
                                previousClassName="page-item"
                                previousLinkClassName="page-link"
                                nextClassName="page-item"
                                nextLinkClassName="page-link"
                                breakLabel="..."
                                breakClassName="page-item"
                                breakLinkClassName="page-link"
                                containerClassName="pagination"
                                activeClassName="active"
                                renderOnZeroPageCount={null}
                            />
                        </div>
                    </div>
                    <DeleteConfirmation
                        show={show}
                        handleClose={handleClose}
                        urlDelete={urlDelete}
                        urlRedirect={null}
                        triggerDeleted={triggerDeleted}
                        setTriggerDeleted={setTriggerDeleted}
                    />
                </>
            ) : (
                <>
                    <div
                        className="d-flex justify-content-between align-items-center mx-3 py-3"
                        style={{
                            borderBottom: "#BCBCBC 1px solid",
                        }}
                    >
                        <div
                            className="font-semibold"
                            style={{ cursor: "pointer" }}
                            onClick={() => {
                                toggleEditTanah();
                            }}
                        >
                            &larr; &emsp; Kembali
                        </div>
                        <div className="d-flex gap-2">
                            <div
                                onClick={() => {
                                    toggleEditTanah();
                                }}
                                className="text-center"
                                style={{
                                    cursor: "pointer",
                                    border: "#DC2F2F 1px solid",
                                    padding: "5px 10px",
                                    borderRadius: "5px",
                                    color: "#DC2F2F",
                                    width: "120px",
                                }}
                            >
                                Batal
                            </div>
                            <div className="primary-btn">Simpan</div>
                        </div>
                    </div>
                    <div className="m-3">
                        <h5 style={{ paddingBottom: "20px" }}>
                            Edit Tanah Induk
                        </h5>
                        <form className="form-tambah-tanah d-flex flex-col gap-3 px-5">
                            <div>
                                <label htmlFor="nama-jenis-barang">
                                    Nama/Jenis Barang
                                </label>
                                <input
                                    type="text"
                                    className="w-100"
                                    name="nama-jenis-barang"
                                    value={formData.namaJenisBarang}
                                />
                            </div>
                            <div>
                                <label htmlFor="nilai-aset">Nilai Aset</label>
                                <input
                                    type="text"
                                    className="w-100"
                                    name="nilai-aset"
                                    value={formData.nilaiAset}
                                />
                            </div>
                            <div>
                                <p className="p-0 m-0">Sertifikat</p>
                                <div className="d-flex gap-2">
                                    <div className="d-flex flex-col">
                                        <label htmlFor="sertifikat-nomor">
                                            Nomor
                                        </label>
                                        <input
                                            type="text"
                                            id="sertifikat-nomor"
                                            style={{ width: "100px" }}
                                            value={formData.sertifikatNomor}
                                        />
                                    </div>
                                    <div className="d-flex flex-col">
                                        <label htmlFor="sertifikat-tanggal">
                                            Tanggal
                                        </label>
                                        <input
                                            type="date"
                                            id="sertifikat-tanggal"
                                            style={{ width: "fit-content" }}
                                            value={formatDate(
                                                formData.hakPakaiTanggal
                                            )}
                                        />
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label htmlFor="sertifikat-alamat">
                                    Alamat
                                </label>
                                <textarea
                                    name="sertifikat-alamat"
                                    className="w-100"
                                    defaultValue={formData.alamat}
                                ></textarea>
                            </div>
                            <div>
                                <label htmlFor="sertifikat-luas">
                                    Luas Induk
                                </label>
                                <input
                                    type="text"
                                    className="w-100"
                                    name="sertifikat-luas"
                                    value={formData.luas}
                                />
                            </div>
                        </form>
                    </div>
                </>
            )}
        </LayoutAdmin>
    );
};
