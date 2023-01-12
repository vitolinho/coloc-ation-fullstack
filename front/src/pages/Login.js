import React from 'react';
import { Link } from 'react-router-dom';
import './Login.css';

export const Login = () => {

  const truc = {
    username: "Francis",
    password: "password"
  }

  console.log(JSON.stringify(truc))


  return (
    <div className="registerContainer">
      <div className="backgroundImage"></div>
      <div className="formContainer">
        <div className="formWrapper">
          <span className="logo">Coloc'Ation</span>
          <span className="title">Sign In</span>
          <form>
            <input type="email" placeholder="username" id='email' value='hello' />
            <input type="password" placeholder="password" />
            <button>Sign In</button>
          </form>
          <p>
            You don't have an account? <Link className='linkColor' to={"/register"}>Register</Link>
          </p>
        </div>
      </div>
    </div>
  )
}
