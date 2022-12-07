import { LupaPasswordForm } from "../components/Home/LupaPassword"


export const LupaPassword = () => {
  return (
    <div className="home d-flex flex-row justify-content-center align-items-center">
      {/* pict */}
      <div className="hero-picture">
        <div className="bg-cyanblue">
          <img src="/coverimg.png" alt="home cover" />
        </div>
      </div>

      {/* form */}
      <div className="d-flex flex-col justify-content-center align-items-center w-100">
        <img className="hero-logo" src="/logo.png" alt="logo"/>
        <h2 className="font-semibold">Selamat Datang!</h2>
        <p>Masuk dengan akun milikmu yang sudah terdaftar.</p>
        <LupaPasswordForm />
      </div>
    </div>
  )
}