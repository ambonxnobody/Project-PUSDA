import { FaRegEdit, FaRegTrashAlt } from "react-icons/fa";
import { Link } from "react-router-dom";
import { UPTDashboardTableCol } from "../../UPTDashboard/UPTDashboardTableCol";

export const ManajemenUserRow = ({
  iterator,
  id,
  name,
  email,
  role,
  luas,
  handleShow,
  toggleTambahTanah,
  namaJenisBarang,
  nilaiAset,
  setFormData,
  upt,
  urlDeleteStateChanger,
}) => {
  const apiUrl = process.env.REACT_APP_API_URL;

  return (
    <div
      className="row db-upt-row mx-auto bg-white m-1 py-2"
      style={{ width: "95%", borderRadius: "5px", minHeight: "80px" }}
    >
      <Link
        to={"/manajemenuser/admin/detail-user"}
        className="col-1 number d-flex align-items-center justify-content-center font-semibold "
      ></Link>
      <UPTDashboardTableCol title="NAMA" value={name} />
      <UPTDashboardTableCol title="EMAIL" value={email}/>
      <UPTDashboardTableCol title="ROLE" value={role}/>
      <div
        className="col d-flex gap-4 align-items-center justify-content-center w-100 p-0"
        style={{ fontSize: "20px" }}
      >
        <Link
          to={"/manajemenuser/admin/edit-user/" + id}
          className="d-flex justify-content-center align-items-center p-1 btn"
          style={{
            color: "#286973",
            borderRadius: "50%",
            background: "#EDF9FB",
            aspectRatio: "1",
            flexShrink: "none",
          }}
        >
          <FaRegEdit />
        </Link>
        <div
          className="d-flex justify-content-center align-items-center p-1 btn"
          style={{
            color: "#DC2F2F",
            borderRadius: "50%",
            aspectRatio: "1",
            flexShrink: "none",
          }}
          data-bs-toggle="modal"
          data-bs-target="#modal"
          onClick={() => {
            urlDeleteStateChanger(apiUrl + 'admin/delete/user/' + id);
            handleShow();
          }}
        >
          <FaRegTrashAlt />
        </div>
      </div>
    </div>
  );
};
