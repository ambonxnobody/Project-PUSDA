import { useState } from "react";
import { DeleteConfirmation } from "../UPTDashboard/DeleteConfirmation";

export const ButtonDelete = ({ urlDelete, urlRedirect }) => {
    const [show, setShow] = useState(false);

    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);

    return (
        <div>
            <DeleteConfirmation
                show={show}
                handleClose={handleClose}
                handleShow={handleShow}
                urlDelete={urlDelete}
                urlRedirect={urlRedirect}
                triggerDeleted={null}
                setTriggerDeleted={null}
            />
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
                    setShow(true);
                }}
            >
                Hapus Data
            </div>
        </div>
    );
};
