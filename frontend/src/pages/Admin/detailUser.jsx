import { useState, useEffect } from "react";
import { useNavigate, Link, useParams } from "react-router-dom";
import { ButtonDelete } from "../../components/Button/ButtonDelete";

import LayoutAdmin from "../../components/Layout/layoutAdmin";

export const DetailUser = () => {
    const navigate = useNavigate();
    return (
        <LayoutAdmin>
            <div
                className="d-flex justify-content-between align-items-center mx-3 py-3"
                style={{
                    borderBottom: "#BCBCBC 1px solid",
                }}
            >
                <div
                    className="font-semibold"
                    style={{ cursor: "pointer" }}
                    onClick={() => {
                        navigate(-1);
                    }}
                >
                    &larr; &emsp; Kembali
                </div>
                <div className="d-flex gap-2">
                    <ButtonDelete/>
                    <Link
                        to={"/manajemenuser/admin/edit-user"}
                        className="primary-btn"
                    >
                        Ubah Data
                    </Link>
                </div>
            </div>
            <div className="mx-5">
                <h5 style={{ paddingBottom: "20px", paddingTop: "10px" }}>
                    Detail User
                </h5>
                <div className="d-flex informasi-tanah-bagian gap-5 justify-content-between">
                    <div className="left-form d-flex flex-col gap-3 ">
                        <div>
                            <label htmlFor="nilai-sewa">
                                Nama
                            </label>
                            <h5>
                                a
                            </h5>
                        </div>
                        <div>
                            <label htmlFor="berlaku-dari">
                                Email
                            </label>
                            <h5>b</h5>
                        </div>
                        <div>
                            <label htmlFor="luas-bagian">Role</label>
                            <h5>c</h5>
                        </div>
                    </div>
                </div>
                <div
                    className="d-flex justify-content-between align-items-center py-3"
                    style={{
                        borderBottom: "#BCBCBC 1px solid",
                    }}
                ></div>
            </div>
        </LayoutAdmin>
    );
};
