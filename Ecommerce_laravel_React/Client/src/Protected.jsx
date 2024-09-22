import React, { useEffect } from 'react';
import { useNavigate } from 'react-router-dom';

const Protected = ({ component: Component }) => {
  const navigate = useNavigate();

  useEffect(() => {
    if (!localStorage.getItem('user-info')) {
      navigate('/register');
    }
  }, [navigate]);

  return <Component />; // Render the protected component
};

export default Protected;
