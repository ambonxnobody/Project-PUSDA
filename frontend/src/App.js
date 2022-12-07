import "./App.css";
import { Provider } from "react-redux";
import { BrowserRouter, Routes, Route, Link } from "react-router-dom";
import { Login } from "./pages/Login";
import { LupaPassword } from "./pages/lupaPassword";
import { DashboardAdmin } from "./pages/Admin/dashboardAdmin";
import { TanahIndukAdmin } from "./pages/Admin/tanahIndukAdmin";
import { DetailIndukAdmin } from "./pages/Admin/detailIndukAdmin";
import { DetailBagianSrAdmin } from "./pages/Admin/detailBagianSrAdmin";
import { DetailBagianPppsAdmin } from "./pages/Admin/detailBagianPppsAdmin";
import { TambahIndukAdmin } from "./pages/Admin/TambahAdmin/tambahIndukAdmin";
import { EditBagianSrAdmin } from "./pages/Admin/EditAdmin/editBagianSrAdmin";
import { EditBagianPppsAdmin } from "./pages/Admin/EditAdmin/editBagianPppsAdmin";
import { TambahBagianSrAdmin } from "./pages/Admin/TambahAdmin/tambahBagianSrAdmin";
import { TambahBagianPppsAdmin } from "./pages/Admin/TambahAdmin/tambahBagianPppsAdmin";
import { EditIndukAdmin } from "./pages/Admin/EditAdmin/editIndukAdmin";
import { DashboardUPT } from "./pages/UPT/dashboardUPT";
import { TanahIndukUPT } from "./pages/UPT/tanahIndukUPT";
import { DetailIndukUPT } from "./pages/UPT/detailIndukUPT";
import { TambahIndukUPT } from "./pages/UPT/TambahUPT/tambahIndukUPT";
import { EditIndukUPT } from "./pages/UPT/EditUPT/editIndukUPT";
import { DetailBagianSrUPT } from "./pages/UPT/detailBagianSrUPT";
import { TambahBagianSrUPT } from "./pages/UPT/TambahUPT/tambahBagianSrUPT";
import { EditBagianSrUPT } from "./pages/UPT/EditUPT/editBagianSrUPT";
import { DetailBagianPppsUPT } from "./pages/UPT/detailBagianPppsUPT";
import { TambahBagianPppsUPT } from "./pages/UPT/TambahUPT/tambahBagianPppsUPT";
import { EditBagianPppsUPT } from "./pages/UPT/EditUPT/editBagianPppsUPT";
import { ManajemenUser } from "./pages/Admin/manajemenUser";
import { TambahUser } from "./pages/Admin/TambahAdmin/tambahUser";
import { DetailUser } from "./pages/Admin/detailUser";
import { EditUser } from "./pages/Admin/EditAdmin/editUser";

function App() {
  return (
      <BrowserRouter>
        <Routes>
          <Route path="/" element={<Login />} />
          <Route path="/lupa-password" element={<LupaPassword />} />
          
          <Route path="/dashboard/admin" element={<DashboardAdmin />} />
          <Route path="/manajemenuser/admin" element={<ManajemenUser />} />
          <Route path="/manajemenuser/admin/tambah-user" element={<TambahUser />} />
          <Route path="/manajemenuser/admin/edit-user/:user_id" element={<EditUser />} />
          <Route path="/manajemenuser/admin/detail-user" element={<DetailUser />} />
          <Route path="/upt/:id/admin" element={<TanahIndukAdmin />} />
          <Route path="/upt/:id/admin/detail/:induk_id" element={<DetailIndukAdmin />} />
          <Route path="/upt/:id/admin/tambah-induk" element={<TambahIndukAdmin />} />
          <Route path="/upt/:id/admin/edit-induk/:induk_id" element={<EditIndukAdmin />} />
          <Route path="/upt/:id/admin/detail/:induk_id/tanah-bagian-sr/:children_id" element={<DetailBagianSrAdmin />} />
          <Route path="/upt/:id/admin/detail/:induk_id/tambah-bagian-sr" element={<TambahBagianSrAdmin />} />
          <Route path="/upt/:id/admin/detail/:induk_id/tanah-bagian-sr/edit/:children_id" element={<EditBagianSrAdmin />} />
          <Route path="/upt/:id/admin/detail/:induk_id/tanah-bagian-ppps/:children_id" element={<DetailBagianPppsAdmin />} />
          <Route path="/upt/:id/admin/detail/:induk_id/tambah-bagian-ppps" element={<TambahBagianPppsAdmin />} />
          <Route path="/upt/:id/admin/detail/:induk_id/tanah-bagian-ppps/edit/:children_id" element={<EditBagianPppsAdmin />} />

          <Route path="/dashboard/UPT" element={<DashboardUPT />} />
          <Route path="/upt/:id/UPT" element={<TanahIndukUPT />} />
          <Route path="/upt/:id/UPT/detail/:induk_id" element={<DetailIndukUPT />} />
          <Route path="/upt/:id/UPT/tambah-induk" element={<TambahIndukUPT />} />
          <Route path="/upt/:id/UPT/edit-induk/:induk_id" element={<EditIndukUPT />} />
          <Route path="/upt/:id/UPT/detail/:induk_id/tanah-bagian-sr/:children_id" element={<DetailBagianSrUPT />} />
          <Route path="/upt/:id/UPT/detail/:induk_id/tambah-bagian-sr" element={<TambahBagianSrUPT />} />
          <Route path="/upt/:id/UPT/detail/:induk_id/tanah-bagian-sr/edit/:children_id" element={<EditBagianSrUPT />} />
          <Route path="/upt/:id/UPT/detail/:induk_id/tanah-bagian-ppps/:children_id" element={<DetailBagianPppsUPT />} />
          <Route path="/upt/:id/UPT/detail/:induk_id/tambah-bagian-ppps" element={<TambahBagianPppsUPT />} />
          <Route path="/upt/:id/UPT/detail/:induk_id/tanah-bagian-ppps/edit/:children_id" element={<EditBagianPppsUPT />} />

          <Route
            path="*"
            element={
              <div className="text-center">
                <h3>404 Not Found</h3>
                <Link to="/dashboard">Go to Dashboard</Link>
              </div>
            }
          />
        </Routes>
      </BrowserRouter>
  );
}

export default App;
