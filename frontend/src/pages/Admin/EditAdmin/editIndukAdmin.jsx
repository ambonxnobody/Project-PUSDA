import { useState, useEffect } from "react";
import { useNavigate, useParams } from "react-router-dom";
import LayoutAdmin from "../../../components/Layout/layoutAdmin";

import Swal from "sweetalert2";

export const EditIndukAdmin = () => {
  const apiUrl = process.env.REACT_APP_API_URL;

  const params = useParams();
  const navigate = useNavigate();

  const [induk, setInduk] = useState({});
  const [message, setMessage] = useState([]);

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      let token = localStorage.getItem("token");

      let res = await fetch(apiUrl + "parent/update/" + params.induk_id, {
        method: "POST",
        body: JSON.stringify({
          ...induk,
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
        icon: "success",
        title: "Berhasil",
        text: resJson.message,
        timer: 1000,
      });

      return navigate("/upt/" + params.id + "/admin");
    } catch (error) {
      console.log(error);
    }
  };

  useEffect(() => {
    let token = localStorage.getItem("token");

    const fetchInduk = async () => {
      try {
        let res = await fetch(apiUrl + "parent/" + params.induk_id, {
          method: "GET",
          headers: {
            "Content-type": "application/json; charset=UTF-8",
            Authorization: "Bearer " + token,
          },
        });

        let resJson = await res.json();

        if (res.status != 200) {
          return console.log(resJson.message);
        }

        let resData = resJson.data;
        setInduk(resData);
      } catch (error) {
        console.log(error);
      }
    };

    fetchInduk().catch(console.error);
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
        <h5 style={{ paddingBottom: "20px" }}>Edit Tanah Induk</h5>

        {/* <div className="error-text-container w-100">
          {message.map((item, key) => {
            return (
              <div className="text-danger" key={key}>
                {item}
              </div>
            );
          })}
        </div> */}

        <form className="form-tambah-tanah d-flex flex-col gap-3 px-5">
          <div>
            <label htmlFor="nama-jenis-barang">Nama/Jenis Barang</label>
            <input
              type="text"
              className="w-100"
              name="nama-jenis-barang"
              value={induk.item_name}
              onChange={(e) =>
                setInduk({
                  ...induk,
                  item_name: e.target.value,
                })
              }
            />
          </div>
          <div>
            <label htmlFor="nilai-aset">Nilai Aset</label>
            <input
              type="text"
              className="w-100"
              name="nilai-aset"
              value={induk.asset_value}
              onChange={(e) =>
                setInduk({
                  ...induk,
                  asset_value: e.target.value,
                })
              }
            />
          </div>
          <div>
            <p className="p-0 m-0">Sertifikat</p>
            <div className="d-flex gap-2">
              <div className="d-flex flex-col">
                <label htmlFor="sertifikat-nomor">Nomor</label>
                <input
                  type="text"
                  id="sertifikat-nomor"
                  style={{ width: "100px" }}
                  value={induk.certificate_number}
                  onChange={(e) =>
                    setInduk({
                      ...induk,
                      certificate_number: e.target.value,
                    })
                  }
                />
              </div>
              <div className="d-flex flex-col">
                <label htmlFor="sertifikat-tanggal">Tanggal</label>
                <input
                  type="date"
                  id="sertifikat-tanggal"
                  style={{ width: "fit-content" }}
                  value={induk.certificate_date}
                  onChange={(e) =>
                    setInduk({
                      ...induk,
                      certificate_date: e.target.value,
                    })
                  }
                />
              </div>
            </div>
          </div>
          <div>
            <label htmlFor="sertifikat-alamat">Alamat</label>
            <textarea
              name="sertifikat-alamat"
              className="w-100"
              value={induk.address}
              onChange={(e) =>
                setInduk({
                  ...induk,
                  address: e.target.value,
                })
              }
            ></textarea>
          </div>
          <div>
            <label htmlFor="sertifikat-luas"> Luas Tanah Bidang  (m²)</label>
            <input
              type="text"
              className="w-100"
              name="sertifikat-luas"
              value={induk.large}
              onChange={(e) =>
                setInduk({
                  ...induk,
                  large: e.target.value,
                })
              }
            />
          </div>
          {/* <div>
                        <label htmlFor="sertifikat-nilai">Nilai Aset</label>
                        <input
                            type="text"
                            className="w-100"
                            name="sertifikat-nilai"
                        />
                    </div> */}
        </form>
      </div>
    </LayoutAdmin>
  );
};
