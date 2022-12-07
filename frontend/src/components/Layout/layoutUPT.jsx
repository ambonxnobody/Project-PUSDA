import React from "react";
import { Navbar } from "../Navbar";
import { SideMenuUPT } from "../SideMenu/SideMenuUPT";


export default function LayoutUPT({ children }) {
  return (
    <div className="d-flex ">
      <SideMenuUPT />
      <div className="w-100">
        <Navbar />
        <main className=" bg-light-gray h-100">
            {children}
        </main>
      </div>
    </div>
  );
}
