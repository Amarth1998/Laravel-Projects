import React, { useEffect, useState } from 'react';
import { useParams, useNavigate } from 'react-router-dom';

const UpdateProduct = () => {
  const [data, setData] = useState({
    name: '',
    price: '',
    description: '',
    file: null, // Store the file object
  });
  const [message, setMessage] = useState('');
  const { id } = useParams(); // Get the product ID from the URL
  const navigate = useNavigate(); // For navigation after update

  // Fetch the single product details when the component loads
  useEffect(() => {
    async function fetchProduct() {
      let result = await fetch('http://127.0.0.1:8000/api/getSingleproduct/' + id);
      result = await result.json();
      setData({ ...result, file: null }); // Set the product data to the state, resetting the file
    }
    fetchProduct(); // Call the fetch function when component mounts
  }, [id]);

  // Handle product update
  const handleUpdate = async () => {
    if (!data.name || !data.price || !data.description) {
      setMessage('Please fill in all fields');
      return;
    }
    const formData = new FormData();
    formData.append('name', data.name);
    formData.append('price', data.price);
    formData.append('description', data.description);
    if (data.file) {
      formData.append('file', data.file); // Append the file if it exists
    }

    try {
      let result = await fetch(`http://127.0.0.1:8000/api/update/${id}`, {
        method: 'POST',
        body: formData,
      });

      if (result.ok) {
        setMessage('Product updated successfully');
        navigate('/list'); // Redirect to the product list after update
      } else {
        setMessage('Failed to update product');
      }
    } catch (error) {
      console.error('Error:', error);
      setMessage('Error updating product');
    }
  };

  return (
    <div  className='col-sm-6 offset-sm-3'>
      <h1>Update Product</h1>
      <input type="text" value={data.name}  onChange={(e) => setData({ ...data, name: e.target.value })}  className="form-control"  placeholder="Product Name"/><br />

      <input type="text" value={data.price}  onChange={(e) => setData({ ...data, price: e.target.value })}  className="form-control"  placeholder="Product Price"/><br />

      <input type="text" value={data.description}  onChange={(e) => setData({ ...data, description: e.target.value })}  className="form-control"  placeholder="Product Description"/><br />

      <input type="file" onChange={(e) => setData({ ...data, file: e.target.files[0] })}  className="form-control"/><br />
      
      {data.filepath && (
        <img style={{ width: '80px' ,textAlign:"center" }} src={`http://localhost:8000/${data.filepath}`} alt="Product"  />
      )}

      <br />

      <button onClick={handleUpdate} className="form-control btn btn-primary" >Update</button>

      {message && <p>{message}</p>} {/* Display success or error messages */}
    </div>
  );
};

export default UpdateProduct;
