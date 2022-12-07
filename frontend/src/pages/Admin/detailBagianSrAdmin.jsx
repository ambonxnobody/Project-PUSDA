import { useNavigate, Link, useParams } from "react-router-dom";
import { useState, useEffect } from "react";
import LayoutAdmin from "../../components/Layout/layoutAdmin";
import { ModalPembayaran } from "../../components/Modal/ModalPembayaran";
import { ModalPembayaranEdit } from "../../components/Modal/ModalPembayaranEdit";
import { ButtonDelete } from "../../components/Button/ButtonDelete";
import { TablePembayaran } from "../../components/Table/TablePembayaran";
import ReactPaginate from "react-paginate";

export const DetailBagianSrAdmin = () => {
    const backendUrl = process.env.REACT_APP_BACKEND_URL;
    const apiUrl = process.env.REACT_APP_API_URL;

    const navigate = useNavigate();
    const [show, setShow] = useState(false);
    const [showEdit, setShowEdit] = useState(false);
    const params = useParams();

    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);
    const handleCloseEdit = () => setShowEdit(false);
    const handleShowEdit = () => setShowEdit(true);

    //format date into yyyy-mm-dd with leading zero
    const formatDate = (date) => {
        const d = new Date(date);
        const month = `${d.getMonth() + 1}`.padStart(2, "0");
        const day = `${d.getDate()}`.padStart(2, "0");
        const year = d.getFullYear();
        return [year, month, day].join("-");
    };

    const formatter = new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
    });

    const mapType = (str) => {
        if (str === "sewa_sip_bmd") return "Sewa/SIP BMD";
        else if (str === "retribusi") return "Retribusi";

        return null;
    };

    const handlePageClick = (e) => {
        if (e.selected >= 0) {
            setPageNum(e.selected + 1);
        }
    };

    const [children, setChildren] = useState({});
    const [payment, setPayment] = useState([]);
    const [pageNum, setPageNum] = useState(1);
    const [pageCount, setPageCount] = useState(0);
    const [startingPoint, setStartingPoint] = useState(0);
    const [emptyMsg, setEmptyMsg] = useState("");
    const [paymentEdit, setPaymentEdit] = useState({});

    const [triggerDeleted, setTriggerDeleted] = useState(false);

    useEffect(() => {
        let token = localStorage.getItem("token");

        const fetchChildren = async () => {
            try {
                let res = await fetch(
                    apiUrl + "childer/" + params.children_id,
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

                let resData = resJson.data;

                setChildren(resData);
            } catch (error) {
                console.log(error);
            }
        };

        const fetchPayment = async () => {
            try {
                let res = await fetch(
                    apiUrl +
                        "payment/all?page=" +
                        pageNum +
                        "&childrens_id=" +
                        params.children_id,
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

                setPageCount(resJson.data.last_page);
                setStartingPoint(
                    resJson.data.per_page * resJson.data.current_page -
                        (resJson.data.per_page - 1)
                );

                let resData = resJson.data.data;
                if (resData.length == 0) return setEmptyMsg("Tidak ada data");

                setEmptyMsg("");

                setPayment(resData);
            } catch (error) {
                console.log(error);
            }
        };

        fetchChildren().catch(console.error);
        fetchPayment().catch(console.error);
    }, [triggerDeleted, pageNum]);

    return (
        <LayoutAdmin>
            <ModalPembayaran
                show={show}
                handleClose={handleClose}
                handleShow={handleShow}
                parentPayment={payment}
                setParentPayment={setPayment}
                setEmptyMsg={setEmptyMsg}
            />

            <ModalPembayaranEdit
                showEdit={showEdit}
                handleCloseEdit={handleCloseEdit}
                handleShowEdit={handleShowEdit}
                parentPayment={payment}
                setParentPayment={setPayment}
                paymentEdit={paymentEdit}
                setPaymentEdit={setPaymentEdit}
            />

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
                        navigate(-1);
                    }}
                >
                    &larr; &emsp; Kembali
                </div>
                <div className="d-flex gap-2">
                    <ButtonDelete
                        urlDelete={
                            apiUrl + "childer/delete/" + params.children_id
                        }
                        urlRedirect={
                            "/upt/" +
                            params.id +
                            "/admin/detail/" +
                            params.induk_id
                        }
                    />
                    <Link
                        to={
                            "/upt/" +
                            params.id +
                            "/admin/detail/" +
                            params.induk_id +
                            "/tanah-bagian-sr/edit/" +
                            params.children_id
                        }
                        className="primary-btn"
                    >
                        Ubah Data
                    </Link>
                </div>
            </div>
            <div className="mx-5">
                <h5 style={{ paddingBottom: "20px", paddingTop: "10px" }}>
                    Informasi Tanah Bagian
                </h5>
                <div className="d-flex informasi-tanah-bagian gap-5 justify-content-between">
                    <div className="left-form d-flex flex-col gap-3 ">
                        <div>
                            <label htmlFor="nilai-sewa">
                                Jenis Perikatan Pemanfaatan
                            </label>
                            <h5>
                                {mapType(children.utilization_engagement_type)}
                            </h5>
                        </div>
                        <div>
                            <label htmlFor="jenis-pemanfaatan">Atas Nama</label>
                            <h5>{children.utilization_engagement_name}</h5>
                        </div>
                        <div>
                            <label htmlFor="berlaku-dari">
                                Peruntukkan Pemanfaatan
                            </label>
                            <h5>{children.allotment_of_use}</h5>
                        </div>
                        <div>
                            <label htmlFor="koordinat">Koordinat (LS BT)</label>
                            <h5>{children.coordinate}</h5>
                        </div>
                        <div>
                            <label htmlFor="luas-bagian">Luas Induk (m)</label>
                            <h5>{children.large}</h5>
                        </div>
                        <div>
                            <label htmlFor="luas-bagian">
                                Nilai Sewa/Retribusi (Rp/Tahun)
                            </label>
                            <h5>
                                {formatter.format(children.rental_retribution)}
                            </h5>
                        </div>
                    </div>
                    <div
                        className="right-form d-flex flex-col gap-3"
                        style={{ paddingRight: "100px" }}
                    >
                        <div>
                            <label htmlFor="nomor-perikatan">
                                Masa Berlaku
                            </label>
                            <h5>
                                {formatDate(children.validity_period_of)} -{" "}
                                {formatDate(children.validity_period_until)}
                            </h5>
                        </div>
                        <div>
                            <label htmlFor="nomor-perikatan">
                                Nomor Perikatan
                            </label>
                            <h5>{children.engagement_number}</h5>
                        </div>
                        <div>
                            <label htmlFor="tanggal-perikatan">
                                Tanggal Perikatan
                            </label>
                            <h5>{formatDate(children.engagement_date)}</h5>
                        </div>
                        <div className="d-flex flex-col">
                            <label className="font-semibold">
                                Surat Perjanjian
                            </label>
                            <h5 className="filename">
                                <a
                                    href={
                                        backendUrl + children.agreement_letter
                                    }
                                    target="_blank"
                                >
                                    SURAT PERJANJIAN-1.PDF
                                </a>
                            </h5>
                        </div>
                        <div className="d-flex flex-col">
                            <label className="font-semibold">
                                Surat Permohonan
                            </label>
                            <h5 className="filename">
                                <a
                                    href={
                                        backendUrl + children.application_letter
                                    }
                                    target="_blank"
                                >
                                    SURAT PERMOHONAN-1.PDF
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
                <div
                    className="d-flex justify-content-between align-items-center py-3"
                    style={{
                        borderBottom: "#BCBCBC 1px solid",
                    }}
                ></div>
                <div className="mx-3">
                    <div
                        className="d-flex flex-row justify-content-between px-3 py-3"
                        style={{ marginTop: "30px" }}
                    >
                        <h5>Informasi Pembayaran</h5>
                        <div className="d-flex">
                            <div
                                to="/upt/tambah"
                                className="primary-btn d-flex justify-content-center align-items-center"
                                onClick={() => {
                                    setShow(true);
                                }}
                            >
                                Tambah Data
                            </div>
                        </div>
                    </div>
                    <div className="table-informasi-pembayaran">
                        {emptyMsg === "" ? (
                            payment.map((item, key) => {
                                return (
                                    <TablePembayaran
                                        iterator={startingPoint + key}
                                        payment={item}
                                        triggerDeleted={triggerDeleted}
                                        setTriggerDeleted={setTriggerDeleted}
                                        setShowEdit={setShowEdit}
                                        setPaymentEdit={setPaymentEdit}
                                    />
                                );
                            })
                        ) : (
                            <>
                                <div className="text-center">{emptyMsg}</div>
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
            </div>
        </LayoutAdmin>
    );
};
