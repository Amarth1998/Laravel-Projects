import React, { useState } from 'react';

const Addproduct = () => {
  const [name, setName] = useState('');
  const [price, setPrice] = useState('');
  const [file, setFile] = useState(null); // Ensure it's set to null initially for file input
  const [description, setDescription] = useState('');
  const [message, setMessage] = useState(''); // State for showing success/error messages

  async function addProduct() {
    if (!name || !price || !file || !description) {
      setMessage('Please fill in all fields');
      return;
    }

    const formData = new FormData();
    formData.append('name', name);
    formData.append('price', price);
    formData.append('file', file);
    formData.append('description', description);

    try {
      let result = await fetch('http://127.0.0.1:8000/api/addproduct', {
        method: 'POST',
        body: formData,
      });
      if (result.ok) {  setMessage('Product added successfully');} 
      else {  setMessage('Failed to add product');}
    } 
    catch (error) {
      console.error('Error:', error);
      setMessage('Error adding product');
    }
  }

  return (
    <div>
      <h1>Add Product</h1>
      <div className='col-sm-6 offset-sm-3'>
        <input  onChange={(e) => setName(e.target.value)}  value={name}  type='text'  className='form-control'  placeholder='Product Name'/>{' '}
        <br />
        <input  onChange={(e) => setPrice(e.target.value)}  value={price}  type='text'  className='form-control'  placeholder='Product Price' />{' '}
        <br />
        <input onChange={(e) => setFile(e.target.files[0])} type='file' className='form-control'/>{' '}
        <br />
        <input onChange={(e) => setDescription(e.target.value)}value={description}  type='text' className='form-control' placeholder='Product Description'/>{' '}
        <br />
        <button onClick={addProduct} className='btn btn-primary'>Submit </button>

        {/* Display success or error messages */}
        {message && <p>{message}</p>}
      </div>
    </div>
  );
};

export default Addproduct;
