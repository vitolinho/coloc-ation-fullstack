import React from 'react'
import addgroup from '../img/addgroup.png'
import deletegroup from '../img/deletegroup.png'
import image from '../img/logout.png'
import './Home.css'

export const Home = () => {
  return (
    <div>
      <header className="header" id="header">
        <nav className="nav container">
          <p className="nav__logo">
            Coloc'Ation
          </p>
          <div className="nav__menu" id="nav-menu">
            <ul className="nav__list">
              <li className="nav__item">
                <a href="#home" className="nav__link">Home</a>
              </li>
              <div className="nav__link">
                <button className="button nav__button">
                  <img className='logoutBTN' src={image} alt='logout'/>
                </button>
              </div>
            </ul>

            <div className="nav__close" id="nav-close">
              <i className="ri-close-line"></i>
            </div>
          </div>

          <div className="nav__toggle" id="nav-toggle">
            X
          </div>
        </nav>
      </header>
      <div className='groupContainer'>
        <div className='backgroundGroup'>
          <div className='groupHeader'>
            <p className='headerText'>Bonjour <span className='headerUsername'> ( username ) </span>, les comptes sont bon ?</p>
            <div>
            <button className='groupButton'>
              <img className='addgroup' src={addgroup} alt='addgroup'/>
            </button>
            <button className='groupButton'>
              <img className='deletegroup' src={deletegroup} alt='deletgroup'/>
            </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}
