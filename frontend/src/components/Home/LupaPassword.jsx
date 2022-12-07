import { useState } from "react";
import { ModalResetPassword } from "../Modal/ModalResetPassword";

export const LupaPasswordForm = () => {
    const apiUrl = process.env.REACT_APP_API_URL;

    const [show, setShow] = useState(false);
    const [message, setMessage] = useState([]);
    const [input, setInput] = useState({
        email: "",
        password: "",
        password_confirmation: "",
    });

    const handleSubmit = async (e) => {
        e.preventDefault();

        setMessage([]);

        // validate
        if (input.password !== input.password_confirmation) {
            return setMessage(["Password dan Konfirmasi Password tidak sama"]);
        }

        try {
            let token = localStorage.getItem("token");

            let res = await fetch(apiUrl + "user/change-password", {
                method: "POST",
                body: JSON.stringify(input),
                headers: {
                    "Content-type": "application/json; charset=UTF-8",
                    Authorization: "Bearer " + token,
                },
            });

            let resJson = await res.json();

            if (res.status != 200) {
                let message = resJson.message;

                if (!Array.isArray(message)) message = [resJson.message];

                return setMessage(message);
            } else if (resJson.status === "Authorization Token not found") {
                return setMessage([resJson.status]);
            }

            return setShow(true);
        } catch (error) {
            console.log(error);
        }
    };

    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);
    return (
        <form className="d-flex flex-col justify-content-center align-items-center h-100 w-75 gap-1">
            <ModalResetPassword
                show={show}
                handleClose={handleClose}
                handleShow={handleShow}
            />
            <div className="form-group w-100">
                <label htmlFor="email">Email</label>
                <input
                    className="rounded"
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Masukkan Email"
                    value={input.email}
                    onChange={(e) =>
                        setInput({
                            ...input,
                            email: e.target.value,
                        })
                    }
                    required
                />
            </div>
            <div className="form-group w-100">
                <label htmlFor="password">Kata Sandi Baru</label>
                <input
                    className="rounded"
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Min. 8 karakter"
                    value={input.password}
                    onChange={(e) =>
                        setInput({
                            ...input,
                            password: e.target.value,
                        })
                    }
                    required
                />
            </div>
            <div className="form-group w-100">
                <label htmlFor="password">Konfirmasi Kata Sandi Baru</label>
                <input
                    className="rounded"
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Min. 8 karakter"
                    value={input.password_confirmation}
                    onChange={(e) =>
                        setInput({
                            ...input,
                            password_confirmation: e.target.value,
                        })
                    }
                    required
                />
            </div>

            {/* Error text container */}
            <div className="error-text-container w-100">
                {message.map((item, key) => {
                    return (
                        <div className="text-danger" key={key}>
                            {" "}
                            {item}{" "}
                        </div>
                    );
                })}
            </div>

            <div
                className="form-group submit-btn w-100 gap-2 rounded bg-cyanblue text-light form-btn mt-2 font-semibold text-center"
                type="submit"
                onClick={handleSubmit}
            >
                Reset Kata Sandi
            </div>
        </form>
    );
};
