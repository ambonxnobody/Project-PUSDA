import React from "react";
import { Navbar } from "../Navbar";
import { SideMenuAdmin } from "../SideMenu/SideMenuAdmin";

export default function LayoutAdmin({ children, ...rest }) {

  return (
    <div className="d-flex">
      <SideMenuAdmin />
      <div className="w-100">
        <Navbar />
        <main className=" bg-light-gray h-100">
          {children}
        </main>
      </div>
    </div>
  );
}
