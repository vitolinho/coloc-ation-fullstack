import React, { useState } from "react";
import { Link } from "react-router-dom";
import "./Login.css";

export const Login = () => {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');

  const user = {
    usernameJSON: username,
    passwordJSON: password,
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    console.log(JSON.stringify(user));
    let reponse = await fetch('http://localhost:2345/login',
      {
        method: 'POST',
        credentials: 'include',
        headers: new Headers({
          "Content-type": "application/json"
        }),
        body: JSON.stringify(user),
        mode: 'cors'
      }
    )
      .then(e => reponse.json())
      .then(json => console.log(json))
  }

  const handleInputUsername = (e) => {
    setUsername(e.target.value)
  }
  const handleInputPassword = (e) => {
    setPassword(e.target.value)
  }

  return (
    <div className="registerContainer">
      <div className="backgroundImage"></div>
      <div className="formContainer">
        <div className="formWrapper">
          <span className="logo">Coloc'Ation</span>
          <span className="title">Sign In</span>
          <form onSubmit={handleSubmit}>
            <input
              type="text"
              placeholder="username"
              id="username"
              name="username"
              onChange={handleInputUsername}
            />
            <input
              type="password"
              placeholder="password"
              id="password"
              name="password"
              onChange={handleInputPassword}
            />
            <button>Sign In</button>
          </form>
          <p>
            You don't have an account?{" "}
            <Link className="linkColor" to={"/register"}>
              Register
            </Link>
          </p>
        </div>
      </div>
    </div>
  );
};
