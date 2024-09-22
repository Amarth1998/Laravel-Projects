import React, { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";
const Login = () => {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [message, setMessage] = useState(""); // State to store error/success messages
  const navigate = useNavigate();

  useEffect(() => {
    // Redirect if user is already logged in
    if (localStorage.getItem("user-info")) {
      navigate("/add");
    }
  }, [navigate]);

  const login = async () => {
    let item = { email, password };

    try {
      const response = await fetch("http://127.0.0.1:8000/api/login", {
        // Make sure the port matches your API
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
        body: JSON.stringify(item),
      });

      const result = await response.json();

      // Check if login was successful
      if (response.ok) {
        // Store user info in local storage
        localStorage.setItem("user-info", JSON.stringify(result.user)); // Adjust based on your response
        navigate("/add"); // Redirect to the add page
      } else {
        setMessage(result.error || "Login failed"); // Display error message
      }
    } catch (error) {
      setMessage("An error occurred. Please try again."); // Handle network errors
      console.error("Error:", error);
    }
  };

  return (
    <div className="col-sm-6 offset-sm-3">
      <h1>Login Page</h1>
      <div>
        <input
          onChange={(e) => setEmail(e.target.value)}
          type="text"
          placeholder="Enter Email"
          value={email}
          className="form-control"
        />{" "}
        <br />
        <input
          onChange={(e) => setPassword(e.target.value)}
          type="password"
          placeholder="Enter Password"
          className="form-control"
          value={password}
        />{" "}
        <br />
        <button className="btn btn-primary" onClick={login}>
          Login
        </button>
        {/* Display error/success messages */}
        {message && <p>{message}</p>}
      </div>
    </div>
  );
};

export default Login;
