import React from 'react'
import { Link } from 'react-router-dom'
import './Register.css'


export const Register = () => {
  return (
    <div className="registerContainer">
      <div className="backgroundImage"></div>
      <div className="formContainer">
        <div className="formWrapper">
          <span className="logo">Coloc'Ation</span>
          <span className="title">Register</span>
          <form>
            <input type="text" placeholder="username" />
            <input type="email" placeholder="email" />
            <input type="password" placeholder="password" />
            <button>Sign Up</button>
          </form>
          <p>
            You already have an account? <Link className='linkColor' to={"/"}>Login</Link>
          </p>
        </div>
      </div>
    </div>
  )
}
