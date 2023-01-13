import React, { useState } from "react";
import { Link } from "react-router-dom";
import "./Register.css";

export const Register = () => {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [mail, setMail] = useState('');

  const user = {
    username: username,
    mail: mail,
    password: password,
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    console.log(JSON.stringify(user));
    let reponse = await fetch('http://localhost:2345/register',
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
      .then(e => e.json())
      .then(json => console.log(json))
  }

  const handleInputUsername = (e) => {
    setUsername(e.target.value)
  }
  const handleInputMail = (e) => {
    setMail(e.target.value)
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
          <span className="title">Register</span>
          <form onSubmit={handleSubmit}>
            <input type="text" placeholder="username" id="username" name="username" onChange={handleInputUsername} />
            <input type="email" placeholder="email" id="email" name="email" onChange={handleInputMail} />
            <input type="password" placeholder="password" id="password" name="password" onChange={handleInputPassword} />
            <button>Sign Up</button>
          </form>
          <p>
            You already have an account?{" "}
            <Link className="linkColor" to={"/"}>
              Login
            </Link>
          </p>
        </div>
      </div>
    </div>
  );
};
