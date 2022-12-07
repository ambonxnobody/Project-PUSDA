import { Link, useParams } from "react-router-dom";

export const TableBagianPinjamPakai = ({ iterator, upt, children }) => {
  const params = useParams();

  const mapType = (str) => {
    if (str === "pinjam_pakai") return "Pinjam Pakai";
    else if (str === "pakai_sendiri") return "Pakai Sendiri";

    return "";
  };

  return (
    <Link
      to={
        "/upt/" +
        upt +
        "/admin/detail/" +
        params.induk_id +
        "/tanah-bagian-ppps/" +
        children.id
      }
      className="row text-dark"
      style={{
        background: "#FFFFFF",
        padding: "15px",
        borderBottom: "#BCBCBC 1px solid",
      }}
    >
      <div
        to="/upt/detail"
        className="col-1 number d-flex align-items-center justify-content-center font-semibold "
      >
        {iterator}
      </div>
      <div className="col">
        <p className="table-title p-0 m-0">PENGGUNAN/ PEMANFAATAN</p>
        <p className="p-0 m-0">
          {mapType(children.utilization_engagement_type)}
        </p>
      </div>
      <div className="col">
        <p className="table-title p-0 m-0"></p>
        <p className="p-0 m-0"></p>
      </div>
      <div className="col">
        <p className="table-title p-0 m-0">PEMANFAATAN</p>
        <p className="p-0 m-0">{children.allotment_of_use}</p>
      </div>
      <div className="col">
        <p className="table-title p-0 m-0"></p>
        <p className="p-0 m-0"></p>
      </div>
      <div className="col">
        <p className="table-title p-0 m-0">KONDISI SAAT INI</p>
        <p className="p-0 m-0">{children.present_condition}</p>
      </div>
      <div className="col">
        <p className="table-title p-0 m-0">LUAS</p>
        <p className="p-0 m-0">{children.large} (m²)</p>
      </div>
    </Link>
  );
};
