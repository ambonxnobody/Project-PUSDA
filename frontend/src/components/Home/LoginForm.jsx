import { useState } from "react";
import { Button } from "react-bootstrap";
import { Link, useNavigate } from "react-router-dom";

export const LoginForm = () => {
  const apiUrl = process.env.REACT_APP_API_URL;

  const navigate = useNavigate();
  const [message, setMessage] = useState([]);
  const [input, setInput] = useState({
    email: "",
    password: "",
  });

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      let res = await fetch(apiUrl + "login", {
        method: "POST",
        body: JSON.stringify(input),
        headers: {
          'Content-type': 'application/json; charset=UTF-8',
        },
      });

      let resJson = await res.json();

      if (res.status != 200) {
        let message = resJson.message;

        if (! Array.isArray(message))
          message = [resJson.message];

        return setMessage(message);
      }

      // Check roles
      localStorage.setItem('user_id', resJson.user.id);
      localStorage.setItem('user_name', resJson.user.name);
      localStorage.setItem('user_slug', resJson.user.slug);
      localStorage.setItem('token', resJson.token);

      let roles = resJson.user.roles;
      if (roles.filter(e => e.name === 'admin').length > 0) {
        return navigate('/dashboard/admin');
      }
      
      return navigate('/dashboard/upt');

    } catch (error) {
      console.log(error);
    }
  };

  return (
    <form  onSubmit={handleSubmit} className="d-flex flex-col justify-content-center align-items-center h-100 w-75 gap-1">
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
        <label htmlFor="password">Kata Sandi</label>
        <input
          className="rounded"
          type="password"
          name="password"
          id="password"
          placeholder="Masukkan Kata Sandi"
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

      {/* Error text container */}
      <div className="error-text-container w-100">
        { message.map((item, key) => {
          return <div className="text-danger" key={key}> {item} </div>;
        }) }
      </div>

      <div className="form-group submit-btn w-100 gap-2">
        <Button
          type="submit"
          className="rounded bg-cyanblue text-light form-btn mt-2 font-semibold text-center"
          // loading={isLoading}
        >
          MASUK
        </Button>
        <Link to="/lupa-password" className="rounded text-cyanblue form-btn bg-none font-semibold text-center">
          Forgot Password?
        </Link>
      </div>
    </form>
  );
};
