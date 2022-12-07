import { useNavigate } from "react-router-dom";
import Button from "react-bootstrap/Button";
import Modal from "react-bootstrap/Modal";

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

            await fetch(urlDelete, {
                method: "DELETE",
                body: JSON.stringify({ token }),
                headers: {
                    "Content-type": "application/json; charset=UTF-8",
                },
            });

            if (triggerDeleted !== null) {
                setTriggerDeleted(!triggerDeleted);
            }

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
