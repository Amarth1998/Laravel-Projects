import React from 'react'
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import NavDropdown from 'react-bootstrap/NavDropdown';
import {Link, Outlet} from 'react-router-dom';
import { useNavigate } from 'react-router-dom';

const Header = () => {
  let user =JSON.parse(localStorage.getItem('user-info'))
  const navigate = useNavigate();

  function logout(){
    localStorage.removeItem('user-info') 
    navigate('/')
  }
  return (
    <>
        <Navbar bg="dark" data-bs-theme="dark">
       
          <Navbar.Brand href="#home">E-commerce</Navbar.Brand>
          <Nav className="me-auto navbar_warapper" >
          <Link className='linkk' to="/">Home</Link>
             {
              localStorage.getItem('user-info')?
              <> 
             
              <Link className='linkk'  to="add">Add Product</Link>
              {/* <Link to="update">Update Product</Link> */}
              <Link className='linkk'  to="list">All Product</Link>
              <Link className='linkk'  to="search">Search</Link>


              </>
              :
              <>
                <Link className='linkk'  to="login">Login</Link>
                <Link className='linkk'  to="register">Register</Link></>
             }
         

       
          
          </Nav>
          {
            localStorage.getItem('user-info')?
            <> 
            <Link className='linkk' >Welcome {user && user.name}</Link> &nbsp

            <button className='btn btn-primary'  onClick={logout}>Logout</button>
            </>
            :
            null}
         
          {/* {
              localStorage.getItem('user-info')?  
          <Nav>
            <NavDropdown style={{color:"white"}} title={user && user.name}>
                        <NavDropdown.Item onClick={logout}>
                           Logout
                        </NavDropdown.Item>
            </NavDropdown>
          </Nav>
          :
          null} */}
      </Navbar>

     

    </>
  )
}

export default Header
