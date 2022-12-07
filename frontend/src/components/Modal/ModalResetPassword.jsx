import Button from "react-bootstrap/Button";
import Modal from "react-bootstrap/Modal";
import { useNavigate } from "react-router-dom";

export const ModalResetPassword = ({ show, handleClose }) => {
  const navigate = useNavigate();
  return (
    <>
      <Modal
        show={show}
        onHide={handleClose}
        className="d-flex justify-content-center align-items-center"
      >
        <Modal.Header>
          <Modal.Title className="px-5">
              Berhasil Mengubah Kata Sandi
          </Modal.Title>
        </Modal.Header>
        <Modal.Body className="py-5">
          <p className="d-flex justify-content-center">
            Kata sandi baru milik anda adalah
          </p>
          <h3 className="d-flex justify-content-center fw-bold">1232423523</h3>
          <div
            className="d-flex justify-content-center"
            style={{
              color: "#DC2F2F",
            }}
          >
            Mohon untuk mengingat dan mencatat kata sandi baru anda
          </div>
        </Modal.Body>
        <Modal.Footer className="d-flex justify-content-center">
          <Button
            className="primary-btn"
            onClick={() => {
              navigate("/");
            }}
          >
            Kembali ke Halaman Login
          </Button>
        </Modal.Footer>
      </Modal>
    </>
  );
};
