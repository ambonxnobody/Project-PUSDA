export const UPTDashboardTableCol = ({title, value}) => {
  if(title === "ALAMAT") {
    return (
      <div className="col col-4">
        <p style={{margin:"0px", color:"#9F9F9F"}}>{title}:</p>
        <p className="table-content m-0 d-flex flex-col justify-content-center" style={{color:"#5C5C5C"}}>{value}</p>
      </div>
    );
  } else {
    return (
      <div className="col">
        <p style={{margin:"0px", color:"#9F9F9F"}}>{title}:</p>
        <p className="table-content m-0" style={{color:"#5C5C5C"}}>{value}</p>
      </div>
    );
  }
};
