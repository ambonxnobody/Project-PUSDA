import { useNavigate } from "react-router-dom";
import Button from "react-bootstrap/Button";
import Modal from "react-bootstrap/Modal";

import Swal from "sweetalert2";

export const DeleteConfirmation = ({
    show,
    handleClose,
    urlDelete,
    urlRedirect = null,
    triggerDeleted = null,
    setTriggerDeleted = null,
}) => {
    const navigate = useNavigate();

    const handleDelete = async () => {
        try {
            let token = localStorage.getItem("token");

            let res = await fetch(urlDelete, {
                method: "DELETE",
                body: JSON.stringify({ token }),
                headers: {
                    "Content-type": "application/json; charset=UTF-8",
                },
            });

            let resJson = await res.json();

            if (triggerDeleted !== null) {
                Swal.fire({
                    title: "Terhapus",
                    icon: "success",
                    text: resJson.message,
                    timer: 1000,
                });

                setTriggerDeleted(!triggerDeleted);
            }
            Swal.fire({
                title: "Terhapus",
                icon: "success",
                text: resJson.message,
                timer: 1000,
            });

            handleClose();

            if (urlRedirect !== null) {
                navigate(urlRedirect);
            }
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
                    <Modal.Title>Hapus Data</Modal.Title>
                </Modal.Header>
                <Modal.Body className="py-5">
                    Apakah anda yakin akan menghapus data ini?
                </Modal.Body>
                <Modal.Footer>
                    <Button className="secondary-btn" onClick={handleClose}>
                        Tidak
                    </Button>
                    <Button variant="danger" onClick={handleDelete}>
                        Yakin
                    </Button>
                </Modal.Footer>
            </Modal>
        </>
    );
};
