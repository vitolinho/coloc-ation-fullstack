import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import './Login.css';

export const Login = () => {

  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");

  const user = {
    usernameJSON: username,
    passwordJSON: password
  }

  const handleInput = (e) => {
    setUsername(e.target.value)
  }
  const handleInputPassword = (e) => {
    setPassword(e.target.value)
  }

  console.log(JSON.stringify(user))


  return (
    <div className="registerContainer">
      <div className="backgroundImage"></div>
      <div className="formContainer">
        <div className="formWrapper">
          <span className="logo">Coloc'Ation</span>
          <span className="title">Sign In</span>
          <form>
            <input type="text" placeholder="username" id='username' onChange={handleInput} />
            <input type="password" placeholder="password" id='email' onChange={handleInputPassword} />
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
