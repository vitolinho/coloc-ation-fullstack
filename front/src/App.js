import { BrowserRouter, Route, Routes } from "react-router-dom";
import './App.css';
import { Home } from "./pages/Home";
import { Login } from "./pages/Login";
import { Register } from "./pages/Register";

export function App() {
  return (
    <BrowserRouter>
      <Routes>
          <Route index element={<Login />} />
          <Route path="home" element={<Home />} />
          <Route path="register" element={<Register />} />
      </Routes>
    </BrowserRouter>
  );
}


