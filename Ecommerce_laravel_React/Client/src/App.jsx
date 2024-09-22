import React from "react";
import Header from "./Header";
import Login from "./Login";
import Register from "./Register";
import Addproduct from "./Addproduct";
import Updateproduct from "./Updateproduct";
import Home from "./Home";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import Protected from "./Protected";
import Productlist from "./Productlist";
import Search from "./Search";
const App = () => {
  return (
    <>
      <BrowserRouter>
        <Header />
        <Routes>
          <Route path="/" index element={<Home />} />
          <Route path="/login" element={<Login />} />
          <Route path="/register" element={<Register />} />
          <Route path="/add" element={<Protected component={Addproduct} />} />
          <Route path="/update/:id" element={<Protected component={Updateproduct} />} />
          <Route path="/list" element={<Protected component={Productlist} />} />
          <Route path="/search" element={<Protected component={Search} />} />

        </Routes>
      </BrowserRouter>
    </>
  );
};

export default App;
