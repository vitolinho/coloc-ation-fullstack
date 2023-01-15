import React, { useState } from 'react'
import addgroup from '../img/addgroup.png'
import deletegroup from '../img/deletegroup.png'
import image from '../img/logout.png'
import './Home.css'
import Modal from 'react-modal';
import adddepense from '../img/add_depenses.jpeg'
import { useSelector } from 'react-redux'
import { json, Link, useNavigate } from "react-router-dom";

export const Home = () => {

    const [formData, setFormData] = useState({
      name: '',
      email: '',
      message: '',
    });

    const userInfos = useSelector(store => store.user)
  
    const [modalIsOpen, setModalIsOpen] = useState(false);

    const navigate = useNavigate()
    const dispatch = useDispatch()
  
    const handleChange = (event) => {
      setFormData({
        ...formData,
        [event.target.name]: event.target.value,
      });
    };
  
    const handleSubmit = (event) => {
      event.preventDefault();
      console.log(formData);
      
      setModalIsOpen(false);
    }

    const handleSubmitDisconnect = (e) => {
      e.preventDefault();
      dispatch(logUser(res)) 
      navigate('/login')  
    }
    

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
                <button className="button nav__button" onClick={handleSubmitDisconnect}>
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
            <p className='headerText'>Bonjour : <span className='headerUsername'>{userInfos.user.username}</span>, les comptes sont bon ?</p>
            <div>
            <button className='groupButton' onClick={() => setModalIsOpen(true)}><img className='addgroup' src={addgroup} alt='addgroup'/>
            <Modal
        isOpen={modalIsOpen}
        onRequestClose={() => setModalIsOpen(false)}
      >
        <form onSubmit={handleSubmit}>
          <label>
            Nom du groupe :
            <input
              type="text"
              name="name"
              value={formData.name}
              onChange={handleChange}
            />
          </label>
          <br />
          <label>
            username:
            <input
              type="text"
              name="name"
              value={formData.email}
              onChange={handleChange}
            />
          </label>
          <br />
          <label>
            Message:
            <textarea
              name="message"
              value={formData.message}
              onChange={handleChange}
            />
          </label>
          <br />
          <button type="submit">Envoyer</button>
          <button onClick={() => setModalIsOpen(false)}>Fermer</button>
        </form>
      </Modal>
            </button>
            
            <button className='groupButton'>
              <img className='adddepense' src={adddepense} alt='adddepense'/>
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
