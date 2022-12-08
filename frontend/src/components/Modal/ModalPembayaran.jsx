import { useState } from "react";
import { useNavigate, useParams } from "react-router-dom";
import Button from "react-bootstrap/Button";
import Modal from "react-bootstrap/Modal";

import Swal from "sweetalert2";

export const ModalPembayaran = ({ show, handleClose, parentPayment, setParentPayment, setEmptyMsg }) => {
    const apiUrl = process.env.REACT_APP_API_URL;

    const params = useParams();

    const [payment, setPayment] = useState({
        childrens_id: params.children_id,
        year: "",
        proof_of_payment: "",
        payment_amount: "",
    });

    // const [message, setMessage] = useState([]);

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            let token = localStorage.getItem("token");
            const formData = new FormData();

            for (const key in payment) {
                formData.append(key, payment[key]);
            }
            formData.append("token", token);

            let res = await fetch(apiUrl + "payment/create", {
                method: "POST",
                body: formData,
            });

            let resJson = await res.json();

            if (res.status != 201) {
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

            setPayment({
                childrens_id: params.children_id,
                year: "",
                proof_of_payment: "",
                payment_amount: "",
            });

            handleClose();

            const newData = resJson.data[0];
            setParentPayment([
                ...parentPayment,
                newData
            ])

            setEmptyMsg('')
        } catch (error) {
            console.log(error);
        }
    };

    return (
        <>
            <Modal
                show={show}
                onHide={handleClose}
                className="d-flex justify-content-center align-items-center"
            >
                <Modal.Header closeButton>
                    <Modal.Title>Informasi Pembayaran</Modal.Title>
                    {/* <div className="error-text-container w-100">
                        {message.map((item, key) => {
                            return (
                                <div className="text-danger" key={key}>
                                    {item}
                                </div>
                            );
                        })}
                    </div> */}
                </Modal.Header>
                <Modal.Body className="py-3">
                    <form className="d-flex flex-col form-tambah-tanah gap-2">
                        <div>
                            <label htmlFor="nilai-sewa">Tahun</label>
                            <input
                                type="text"
                                className="w-100"
                                name="nilai-sewa"
                                value={payment.year}
                                onChange={(e) =>
                                    setPayment({
                                        ...payment,
                                        year: e.target.value,
                                    })
                                }
                            />
                        </div>
                        <div>
                            <label htmlFor="nilai-sewa">
                                Jumlah Pembayaran
                            </label>
                            <input
                                type="text"
                                className="w-100"
                                name="nilai-sewa"
                                value={payment.payment_amount}
                                onChange={(e) =>
                                    setPayment({
                                        ...payment,
                                        payment_amount: e.target.value,
                                    })
                                }
                            />
                        </div>
                        <div className="d-flex flex-col">
                            <label className="font-semibold">
                                Bukti Pembayaran
                            </label>
                            <label
                                htmlFor="surat-permohonan"
                                className="font-semibold file-input d-flex flex-col justify-content-center align-items-center"
                            >
                                <img src="/upload.png" width={80} />
                                <p className="p-0 m-0">
                                    Drag & drop files or{" "}
                                    <span style={{ color: "#483EA8" }}>
                                        Browse
                                    </span>
                                </p>
                                <p className="secondary-text">
                                    Supported formates: JPEG, PNG, GIF, MP4,
                                    PDF, PSD, AI, Word, PPT
                                </p>
                            </label>
                            <input
                                type="file"
                                className="d-none"
                                id="surat-permohonan"
                                onChange={(e) =>
                                    setPayment({
                                        ...payment,
                                        proof_of_payment: e.target.files[0],
                                    })
                                }
                            />
                        </div>
                    </form>
                </Modal.Body>
                <Modal.Footer className="d-flex justify-content-center">
                    <Button className="primary-btn px-5" onClick={handleSubmit}>
                        Simpan Data
                    </Button>
                </Modal.Footer>
            </Modal>
        </>
    );
};
