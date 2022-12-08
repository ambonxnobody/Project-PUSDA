import { useState, useEffect } from "react";
import { useNavigate, useParams } from "react-router-dom";
import LayoutAdmin from "../../../components/Layout/layoutAdmin";

import Swal from "sweetalert2";

export const EditBagianPppsAdmin = () => {
    const apiUrl = process.env.REACT_APP_API_URL;

    const navigate = useNavigate();
    const params = useParams();

    const [children, setChildren] = useState({
        parent_id: params.induk_id,
        utilization_engagement_type: "",
        allotment_of_use: "",
        large: "",
        present_condition: "",
        assets_value: "",
        coordinate: "",
        description: "",
    });

    const [message, setMessage] = useState([]);

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            let token = localStorage.getItem("token");

            let res = await fetch(apiUrl + "childer/update/" + params.children_id, {
                method: "POST",
                body: JSON.stringify({
                    ...children,
                    token,
                }),
                headers: {
                    "Content-type": "application/json; charset=UTF-8",
                },
            });

            let resJson = await res.json();

            if (res.status != 200) {
                let message = resJson.message;
                if (!Array.isArray(message)) message = [resJson.message];

                let messageList = "";
                message.forEach((item) => {
                    messageList += "<li>" + item + "</li>";
                });

                return Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    html: messageList,
                    // text: messageList,
                    // timer: 1000,
                });

                // return setMessage(message);
            }

            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: resJson.message,
                timer: 1000,
            });

            return navigate(
                "/upt/" + params.id + "/admin/detail/" + params.induk_id
            );
        } catch (error) {
            console.log(error);
        }
    };

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
        <LayoutAdmin>
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
                    <div
                        className="text-center"
                        style={{
                            cursor: "pointer",
                            border: "#DC2F2F 1px solid",
                            padding: "5px 10px",
                            borderRadius: "5px",
                            color: "#DC2F2F",
                            width: "120px",
                        }}
                        onClick={() => {
                            navigate(-1);
                        }}
                    >
                        Batal
                    </div>
                    <button onClick={handleSubmit} className="primary-btn">
                        Edit Data
                    </button>
                </div>
            </div>
            <div className="mx-5">
                <h5 style={{ paddingBottom: "20px", paddingTop: "10px" }}>
                    Edit Tanah Bagian
                </h5>

                {/* <div className="error-text-container w-100">
                    {message.map((item, key) => {
                        return (
                            <div className="text-danger" key={key}>
                                {item}
                            </div>
                        );
                    })}
                </div> */}

                <form className="d-flex form-tambah-tanah gap-5">
                    <div className="left-form d-flex flex-col gap-3">
                        <div>
                            <label htmlFor="sertifikat-jenispemanfaatan">
                                Jenis Perikatan
                            </label>
                            <select
                                className="form-select"
                                value={children.utilization_engagement_type}
                                onChange={(e) =>
                                    setChildren({
                                        ...children,
                                        utilization_engagement_type:
                                            e.target.value,
                                    })
                                }
                            >
                                <option value="" disabled>
                                    -- Pilih --
                                </option>
                                <option value="pakai_sendiri">
                                    Pakai Sendiri
                                </option>
                                <option value="pinjam_pakai">
                                    Pinjam Pakai
                                </option>
                            </select>
                        </div>
                        <div>
                            <label htmlFor="berlaku-dari">Nilai Asset</label>
                            <input
                                type="text"
                                className="w-100"
                                name="nilai-aset"
                                value={children.assets_value}
                                onChange={(e) =>
                                    setChildren({
                                        ...children,
                                        assets_value: e.target.value,
                                    })
                                }
                            />
                        </div>
                        <div>
                            <label htmlFor="peruntukan-pemanfaatan">
                                Peruntukan Pemanfaatan
                            </label>
                            <input
                                type="text"
                                className="w-100"
                                name="peruntukan-pemanfaatan"
                                value={children.allotment_of_use}
                                onChange={(e) =>
                                    setChildren({
                                        ...children,
                                        allotment_of_use: e.target.value,
                                    })
                                }
                            />
                        </div>
                        <div>
                            <label htmlFor="luas-bagian">Luas Bagian (m²)</label>
                            <input
                                type="text"
                                className="w-100"
                                name="luas-bagian"
                                value={children.large}
                                onChange={(e) =>
                                    setChildren({
                                        ...children,
                                        large: e.target.value,
                                    })
                                }
                            />
                        </div>
                        <div>
                            <label htmlFor="kondisi">Kondisi Saat Ini</label>
                            <input
                                type="text"
                                className="w-100"
                                name="kondisi"
                                value={children.present_condition}
                                onChange={(e) =>
                                    setChildren({
                                        ...children,
                                        present_condition: e.target.value,
                                    })
                                }
                            />
                        </div>
                    </div>
                    <div className="right-form d-flex flex-col gap-3">
                        <div>
                            <label htmlFor="koordinat">Koordinat (LS BT)</label>
                            <input
                                type="text"
                                className="w-100"
                                name="koordinat"
                                value={children.coordinate}
                                onChange={(e) =>
                                    setChildren({
                                        ...children,
                                        coordinate: e.target.value,
                                    })
                                }
                            />
                        </div>
                        <div>
                            <label htmlFor="keterangan">Keterangan</label>
                            <textarea
                                name="keterangan"
                                className="w-100"
                                value={children.description}
                                onChange={(e) =>
                                    setChildren({
                                        ...children,
                                        description: e.target.value,
                                    })
                                }
                            ></textarea>
                        </div>
                    </div>
                </form>
            </div>
        </LayoutAdmin>
    );
};
