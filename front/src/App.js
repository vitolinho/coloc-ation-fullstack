import { useEffect, useReducer } from "react";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import { logUser } from "./Actions/UserAction";
import './App.css';
import { Home } from "./pages/Home";
import { Login } from "./pages/Login";
import { Register } from "./pages/Register";
import { UserReducer } from "./Reducers/UserReducer";

export function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path ="login" element={<Login />} />
        <Route path="home" element={<Home />} />
        <Route path="register" element={<Register />} />
      </Routes>
    </BrowserRouter>
  );
}


