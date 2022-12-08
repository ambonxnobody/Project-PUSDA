import { useState } from "react";
import Button from "react-bootstrap/Button";
import Modal from "react-bootstrap/Modal";

import Swal from "sweetalert2";

export const ModalPembayaranEdit = ({ showEdit, handleCloseEdit, parentPayment, setParentPayment, paymentEdit, setPaymentEdit }) => {
    const apiUrl = process.env.REACT_APP_API_URL;

    const [message, setMessage] = useState([]);

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            let token = localStorage.getItem("token");
            const formData = new FormData();

            for (const key in paymentEdit) {
                formData.append(key, paymentEdit[key]);
            }
            formData.append("token", token);

            let res = await fetch(apiUrl + "payment/update/" + paymentEdit.id, {
                method: "POST",
                body: formData,
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

            handleCloseEdit();

            const newData = resJson.data;
            setParentPayment(parentPayment.map((p) => {
                if (p.id === newData.id) {
                    return {
                        ...p,
                        childrens_id: newData.childrens_id,
                        year: newData.year,
                        proof_of_payment: newData.proof_of_payment,
                        payment_amount: newData.payment_amount,
                    };
                } else {
                    return p;
                }
            }));
        } catch (error) {
            console.log(error);
        }
    };

    return (
        <>
            <Modal
                show={showEdit}
                onHide={handleCloseEdit}
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
                                value={paymentEdit.year}
                                onChange={(e) =>
                                    setPaymentEdit({
                                        ...paymentEdit,
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
                                value={paymentEdit.payment_amount}
                                onChange={(e) =>
                                    setPaymentEdit({
                                        ...paymentEdit,
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
                                    setPaymentEdit({
                                        ...paymentEdit,
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
