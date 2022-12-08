import { useState, useEffect } from "react";
import { Link, useParams } from "react-router-dom";
import LayoutAdmin from "../../components/Layout/layoutAdmin";
import { ManajemenUserRow } from "../../components/Table/TableManajemenUser/ManajemenUserRow";
import ReactPaginate from "react-paginate";
import { DeleteConfirmation } from "../../components/UPTDashboard/DeleteConfirmation";

export const ManajemenUser = () => {
  const apiUrl = process.env.REACT_APP_API_URL;

  const [openEditTanah, setOpenEditTanah] = useState(false);
  const [show, setShow] = useState(false);
  const params = useParams();
  const handleClose = () => setShow(false);
  const handleShow = () => setShow(true);

  //format date into yyyy-mm-dd with leading zero
  const formatDate = (date) => {
    const d = new Date(date);
    const month = `${d.getMonth() + 1}`.padStart(2, "0");
    const day = `${d.getDate()}`.padStart(2, "0");
    const year = d.getFullYear();
    return [year, month, day].join("-");
  };

  const handlePageClick = (e) => {
    if (e.selected >= 0) {
      setPageNum(e.selected + 1);
    }
  };

  const [data, setData] = useState([]);
  const [pageNum, setPageNum] = useState(1);
  const [pageCount, setPageCount] = useState(0);
  const [startingPoint, setStartingPoint] = useState(0);
  const [search, setSearch] = useState("");
  const [urlDelete, setUrlDelete] = useState("");
  const [triggerDeleted, setTriggerDeleted] = useState(false);
  const [emptyMsg, setEmptyMsg] = useState("");

  const [formData, setFormData] = useState({
    name: "",
    email: "",
    password: "",
    role_id: "",
  });

  useEffect(() => {
    const fetchData = async () => {
      let token = localStorage.getItem("token");
      let authorId = localStorage.getItem("active_author_id");

      try {
        let res = await fetch(apiUrl + "user/all?page=" + pageNum, {
          method: "GET",
          headers: {
            "Content-type": "application/json; charset=UTF-8",
            Authorization: "Bearer " + token,
          },
        });

        let resJson = await res.json();

        if (res.status !== 200) {
          return console.log(resJson.message);
        }

        // Check if result is from search
        if (Array.isArray(resJson.data)) {
          setPageCount(1);
          setStartingPoint(1);
        } else {
          setPageCount(resJson.data.last_page);
          setStartingPoint(
            resJson.data.per_page * resJson.data.current_page -
            (resJson.data.per_page - 1)
          );
        }

        let resData = Array.isArray(resJson.data)
          ? resJson.data
          : resJson.data.data;
        if (resData.length === 0) {
          return setEmptyMsg("Tidak ada data.");
        }

        setEmptyMsg("");
        setData(resData);
      } catch (error) {
        console.log(error);
      }
    };

    fetchData().catch(console.error);
  }, [params.id, triggerDeleted, pageNum, search]); // eslint-disable-line react-hooks/exhaustive-deps

  const toggleEditTanah = () => {
    if (openEditTanah) {
      // setNavbarInfo("")
      setOpenEditTanah(false);
    } else {
      // setNavbarInfo("/Tambah Total Tanah")
      setOpenEditTanah(true);
    }
  };

  return (
    <LayoutAdmin>
      <div>
        <div className="d-flex justify-content-between px-3 py-3">
          <div className="d-flex gap-2 align-items-center">
            <Link
              to={"/manajemenuser/admin/tambah-user"}
              className="primary-btn d-flex justify-content-center align-items-center"
            >
              Tambah User
            </Link>
          </div>
          <div className="d-flex">
            <input
              className="form-control me-2 bg-none"
              style={{ width: "200px" }}
              type="search"
              placeholder="Search"
              aria-label="Search"
            ></input>
          </div>
        </div>
        <div>
          {emptyMsg === "" ? (
            <>
              {data.map((item, key) => {
                return (
                  <ManajemenUserRow
                    iterator={startingPoint + key}
                    upt={params.id}
                    key={item.id}
                    id={item.id}
                    name={item.name}
                    role={item.roles[0].name}
                    email={item.email}
                    nilaiAset={item.asset_value}
                    alamat={item.address}
                    luas={item.large}
                    handleShow={handleShow}
                    toggleTambahTanah={toggleEditTanah}
                    setFormData={setFormData}
                    urlDeleteStateChanger={setUrlDelete}
                  />
                );
              })}
            </>
          ) : (
            <>
              <div class="text-center">{emptyMsg}</div>
            </>
          )}

          <div className="pagination-container">
            <ReactPaginate
              nextLabel="next >"
              onPageChange={handlePageClick}
              pageRangeDisplayed={3}
              marginPagesDisplayed={2}
              pageCount={pageCount}
              previousLabel="< previous"
              pageClassName="page-item"
              pageLinkClassName="page-link"
              previousClassName="page-item"
              previousLinkClassName="page-link"
              nextClassName="page-item"
              nextLinkClassName="page-link"
              breakLabel="..."
              breakClassName="page-item"
              breakLinkClassName="page-link"
              containerClassName="pagination"
              activeClassName="active"
              renderOnZeroPageCount={null}
            />
          </div>
        </div>

        <DeleteConfirmation
          show={show}
          handleClose={handleClose}
          urlDelete={urlDelete}
          urlRedirect={null}
          triggerDeleted={triggerDeleted}
          setTriggerDeleted={setTriggerDeleted}
        />
      </div>
    </LayoutAdmin>
  );
};
