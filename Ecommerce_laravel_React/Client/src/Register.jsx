import React, { useState,useEffect } from 'react';
import { useNavigate } from 'react-router-dom'; // Import useNavigate
const Register = () => {
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [message, setMessage] = useState('');

   useEffect(()=>{  if(localStorage.getItem('user-info')){
    navigate('/add');
  }},[])
  
  
  const navigate = useNavigate(); // Initialize useNavigate

  const Signup = async () => {
    let item = { name, email, password };

    
    try {
      let result =await fetch("http://127.0.0.1:8000/api/register",{
        method: "POST",
        body:JSON.stringify(item),
        headers: {
          "Content-Type": "application/json",
          "Accept":'application/json'}
      })
 result =await result.json()
      localStorage.setItem('user-info',JSON.stringify(result) );      // Store data in local storage
      setMessage('User registered successfully');  // Handle success response
      console.log('Response:', result);
      navigate('/add');     // Redirect to the dashboard or another page after successful registration
      
    } catch (error) {
      setMessage('Error registering user'); // Handle error response
      console.error('Error:', error.result ? error.result : error.message);
    }
  };

  return (
    <div className='col-sm-6 offset-sm-3'>
      <h1>Register</h1>
      <input
        onChange={(e) => setName(e.target.value)}  value={name}  type='text'  className='form-control'  placeholder='Name'/> <br />
      <input
        onChange={(e) => setEmail(e.target.value)}  value={email}  type='email'  className='form-control'  placeholder='Email'/> <br />
      <input
        onChange={(e) => setPassword(e.target.value)}  value={password}  type='password'  className='form-control'  placeholder='Password' /> <br />
      <button onClick={Signup} className='btn btn-primary'>Sign Up</button>

      {/* Display success/error messages */}
      {message && <p>{message}</p>}
    </div>
  );
};

export default Register;
