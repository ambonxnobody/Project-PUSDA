import { useState, useEffect } from "react";
import { useNavigate, useParams } from "react-router-dom";
import LayoutAdmin from "../../../components/Layout/layoutAdmin";

import Swal from "sweetalert2";

export const EditUser = () => {
  const apiUrl = process.env.REACT_APP_API_URL;

  const params = useParams();
  const navigate = useNavigate();

  const [user, setUser] = useState({});
  // const [message, setMessage] = useState([]);

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      let token = localStorage.getItem("token");

      let res = await fetch(apiUrl + "user/update/" + params.user_id, {
        method: "PUT",
        body: JSON.stringify({
          ...user,
          token,
        }),
        headers: {
          "Content-type": "application/json; charset=UTF-8",
        },
      });

      let resJson = await res.json();

      if (res.status != 200) {
        let message = resJson.message;
        if (!Array.isArray(message)) message = [resJson.message];

        let messageList = "";
        message.forEach((item) => {
          messageList += "<li>" + item + "</li>";
        });

        return Swal.fire({
          icon: "error",
          title: "Oops...",
          html: messageList,
          // text: messageList,
          // timer: 1000,
        });

        // return setMessage(message);
      }

      Swal.fire({
        title: "Berhasil",
        text: resJson.message,
        icon: "success",
        timer: 1000,
        // position: "center",
        // showConfirmButton: false,
      });

      return navigate("/manajemenuser/admin");
    } catch (error) {
      console.log(error);
    }
  };

  useEffect(() => {
    let token = localStorage.getItem("token");

    const fetchUser = async () => {
      try {
        let res = await fetch(apiUrl + "admin/edit/user/" + params.user_id, {
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

        let resData = resJson;
        console.log(resData);
        setUser(resData);
      } catch (error) {
        console.log(error);
      }
    };

    fetchUser().catch(console.error);
  }, []); // eslint-disable-line react-hooks/exhaustive-deps

  return (
    <LayoutAdmin>
      <div
        className="d-flex justify-content-between align-items-center mx-3 py-3"
        style={{
          borderBottom: "#BCBCBC 1px solid",
        }}
      >
        <div className="font-semibold" style={{ cursor: "pointer" }}>
          <div
            className="font-semibold"
            style={{ cursor: "pointer" }}
            onClick={() => {
              navigate(-1);
            }}
          >
            &larr; &emsp; Kembali
          </div>
        </div>
        <div className="d-flex gap-2">
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
              navigate(-1);
            }}
          >
            Batal
          </div>
          <button onClick={handleSubmit} className="primary-btn">
            Simpan
          </button>
        </div>
      </div>
      <div className="m-3">
        <h5 style={{ paddingBottom: "20px" }}>Edit Data User</h5>
        <form className="form-tambah-tanah d-flex flex-col gap-3 px-5">
          <div>
            <label htmlFor="nama-user">Nama</label>
            <input
              type="text"
              className="w-100"
              name="nama-user"
              value={user.name}
              onChange={(e) =>
                setUser({
                  ...user,
                  name: e.target.value,
                })
              }
            />
          </div>
          <div>
            <label htmlFor="role">Role</label>
            <select
              className="form-select"
              value={user.role_id}
              onChange={(e) =>
                setUser({
                  ...user,
                  role_id: e.target.value,
                })
              }
            >
              <option value="" disabled>
                -- Pilih --
              </option>
              {user.map((item) => {
                return <option value={item.id}>{item.name}</option>;
              })}
            </select>
          </div>
          <div>
            <label htmlFor="email">Email</label>
            <input
              type="text"
              className="w-100"
              name="email"
              value={user.email}
              onChange={(e) =>
                setUser({
                  ...user,
                  email: e.target.value,
                })
              }
            />
          </div>
        </form>
      </div>
    </LayoutAdmin>
  );
};
