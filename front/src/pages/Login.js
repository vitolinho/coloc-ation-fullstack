import React, { useEffect, useState } from "react";
import { useDispatch } from "react-redux";
import { json, Link, useNavigate } from "react-router-dom";
import { logUser } from "../Actions/UserAction";
import { useFetchUser } from "../Hooks/useFetchUser";
import "./Login.css";

export const Login = () => {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');

  const navigate = useNavigate()
  const fetchUser = useFetchUser()
  const dispatch = useDispatch()

  useEffect(() => {
    let jwt = sessionStorage.getItem('jwt')

    if (jwt != 'undefined') {
      let userDecoded = JSON.parse(atob(jwt.split('.')[1]))
      dispatch(logUser({
        user: userDecoded ?? "",
        jwt: jwt
      }))
      navigate('/home')
    }
  }, [])

  const handleSubmit = async (e) => {
    e.preventDefault();
    fetchUser(username, password)
      .then(res => {
        dispatch(logUser(res))
        navigate('/home')
      })
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
