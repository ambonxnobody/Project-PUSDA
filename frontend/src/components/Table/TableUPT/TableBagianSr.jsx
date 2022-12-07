import { Link, useParams } from "react-router-dom";

export const TableBagianSr = ({iterator, upt, children}) => {
  const params = useParams();

  //format date into yyyy-mm-dd with leading zero
  const formatDate = (date) => {
    const d = new Date(date);
    const month = `${d.getMonth() + 1}`.padStart(2, "0");
    const day = `${d.getDate()}`.padStart(2, "0");
    const year = d.getFullYear();
    return [year, month, day].join("-");
  };

  const formatter = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
  });

  const mapType = (str) => {
    if (str === 'sewa_sip_bmd')
      return 'Sewa/SIP BMD'
    else if (str === 'retribusi')
      return 'Retribusi';

    return null;
  }

  return (
    <Link
      to={"/upt/"+upt+"/upt/detail/"+params.induk_id+"/tanah-bagian-sr/"+children.id}
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
        <p className="table-title p-0 m-0">NO PERIKATAN</p>
        <p className="p-0 m-0">{children.engagement_number}</p>
      </div>
      <div className="col">
        <p className="table-title p-0 m-0">JENIS PERIKATAN</p>
        <p className="p-0 m-0">{mapType(children.utilization_engagement_type)}</p>
      </div>
      <div className="col">
        <p className="table-title p-0 m-0">PEMANFAATAN</p>
        <p className="p-0 m-0">{children.allotment_of_use}</p>
      </div>
      <div className="col">
        <p className="table-title p-0 m-0">NILAI SEWA</p>
        <p className="p-0 m-0">{formatter.format(children.rental_retribution)}</p>
      </div>
      <div className="col">
        <p className="table-title p-0 m-0">MASA BERLAKU</p>
        <p className="p-0 m-0">{formatDate(children.validity_period_until)}</p>
      </div>
      <div className="col">
        <p className="table-title p-0 m-0">LUAS</p>
        <p className="p-0 m-0">{children.large} m</p>
      </div>
    </Link>
  );
};
