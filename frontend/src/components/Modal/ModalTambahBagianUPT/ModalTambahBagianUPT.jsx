import Button from "react-bootstrap/Button";
import Modal from "react-bootstrap/Modal";
import { useNavigate, useParams } from "react-router-dom";

export const ModalTambahBagianUPT = ({ show, handleClose }) => {
  const navigate = useNavigate();
  const params = useParams();
  return (
    <>
      <Modal
        show={show}
        onHide={handleClose}
        className="d-flex justify-content-center align-items-center"
      >
        <Modal.Header closeButton>
          <Modal.Title>Tambah Data</Modal.Title>
        </Modal.Header>
        <Modal.Body className="py-5 px-5">
          <div className="mb-3 d-flex justify-content-center">
            <Button
              className="primary-btn"
              onClick={() => {
                navigate("/upt/"+params.id+"/upt/detail/"+params.induk_id+"/tambah-bagian-ppps");
              }}
            >
              Pakai Sendiri / Pinjam Pakai
            </Button>
          </div>
          <div  className="mb-3 d-flex justify-content-center">
            <Button
              className="primary-btn"
              onClick={() => {
                navigate("/upt/"+params.id+"/upt/detail/"+params.induk_id+"/tambah-bagian-sr");
              }}
            >
              Sewa / Retribusi
            </Button>
          </div>
        </Modal.Body>
        <Modal.Footer></Modal.Footer>
      </Modal>
    </>
  );
};
