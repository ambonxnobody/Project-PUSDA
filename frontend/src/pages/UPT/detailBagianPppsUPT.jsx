import { useState, useEffect } from "react";
import { useNavigate, Link, useParams } from "react-router-dom";
import { ButtonDelete } from "../../components/Button/ButtonDelete";

import LayoutUPT from "../../components/Layout/layoutUPT";

export const DetailBagianPppsUPT = () => {
    const apiUrl = process.env.REACT_APP_API_URL;

    const navigate = useNavigate();
    const params = useParams();

    const formatter = new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
    });

    const mapType = (str) => {
        if (str === "pinjam_pakai") return "Pinjam Pakai";
        else if (str === "pakai_sendiri") return "Pakai Sendiri";

        return "";
    };

    const [children, setChildren] = useState({});

    useEffect(() => {
        let token = localStorage.getItem("token");

        const fetchInduk = async () => {
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

        fetchInduk().catch(console.error);
    }, []);
    return (
        <LayoutUPT>
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
                            "/upt/detail/" +
                            params.induk_id
                        }
                    />
                    <Link
                        to={
                            "/upt/" +
                            params.id +
                            "/upt/detail/" +
                            params.induk_id +
                            "/tanah-bagian-ppps/edit/" +
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
                            <label htmlFor="berlaku-dari">
                                Peruntukkan Pemanfaatan
                            </label>
                            <h5>{children.allotment_of_use}</h5>
                        </div>
                        <div>
                            <label htmlFor="luas-bagian">Luas Bagian (m)</label>
                            <h5>{children.large}</h5>
                        </div>
                    </div>
                    <div
                        className="right-form d-flex flex-col gap-3"
                        style={{ paddingRight: "100px" }}
                    >
                        <div>
                            <label htmlFor="nilai-asset">
                                Nilai Asset (Rp/Tahun)
                            </label>
                            <h5>{formatter.format(children.assets_value)}</h5>
                        </div>
                        <div>
                            <label htmlFor="koordinat">Koordinat (LS BT)</label>
                            <h5>{children.coordinate}</h5>
                        </div>
                        <div>
                            <label htmlFor="keterangan">Keterangan</label>
                            <h5>{children.description}</h5>
                        </div>
                    </div>
                </div>
                <div
                    className="d-flex justify-content-between align-items-center py-3"
                    style={{
                        borderBottom: "#BCBCBC 1px solid",
                    }}
                ></div>
            </div>
        </LayoutUPT>
    );
};
