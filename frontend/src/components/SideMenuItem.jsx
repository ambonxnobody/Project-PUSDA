import { Link, useLocation } from "react-router-dom";

export const SideMenuItem = ({ title, id }) => {
  const location = useLocation();
  // console.log(params)
  // console.log(location.pathname);
  // location.pathname === "/dashboard/"+id
  // /dashboard/upt/pusdajatim/detail
  if(location.pathname.indexOf(id) > -1 ) {
    return (
      <Link to={id} className="side-menu-item bg-cyanblue text-white">
        <span className="side-menu-item">{title}</span>
      </Link>
    );
  } else {
    return (
      <Link to={id} className="side-menu-item">
        <span className="side-menu-item fw-bold">{title}</span>
      </Link>
    );
  } 
};
