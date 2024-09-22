import React, { useState } from 'react';
import { Table } from "react-bootstrap";
import _ from 'lodash'; // For debouncing

const Search = () => {
    const [data, setData] = useState([]);
    const [loading, setLoading] = useState(false);
    const [message, setMessage] = useState('');

    const search = async (key) => {
        if (!key) {
            setData([]);
            setMessage('');
            return;
        }

        setLoading(true);
        try {
            let result = await fetch(`http://127.0.0.1:8000/api/search/${key}`);
            result = await result.json();
            if (result.data.length > 0) {
                setData(result.data); // assuming your API returns `data` field
                setMessage('');
            } else {
                setData([]);
                setMessage('No products found');
            }
        } catch (error) {
            console.error('Search Error:', error);
            setMessage('An error occurred while searching');
        }
        setLoading(false);
    };

    // Debounced search function to delay the API call while typing
    const debouncedSearch = _.debounce((key) => search(key), 300);

    return (
        <>
            <div className='col-sm-6 offset-sm-3'>
                <br /> <h1>Search Product</h1> <br />
                <input  type="text"  onChange={(e) => debouncedSearch(e.target.value)}  className='form-control'  placeholder='Search Product'/>
            </div> <br />
            
            <div className="col-sm-8 offset-sm-2">
                {loading && <p>Loading...</p>}
                {message && <p>{message}</p>}

                <Table striped bordered hover variant="dark">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        {data.length > 0 ? (
                            data.map((item) => (
                                <tr key={item.id}> {/* Use item.id as the key */}
                                    <td>{item.id}</td>
                                    <td>{item.name}</td>
                                    <td>{item.price}</td>
                                    <td>{item.description}</td>
                                    <td><img  src={`http://localhost:8000/${item.filepath}`} style={{ width: "50px" }}    alt={item.name}/> </td>
                                </tr>
                            ))
                        ) : !loading && (
                            <tr>
                                <td colSpan="5">No products available</td>
                            </tr>
                        )}
                    </tbody>
                </Table>
            </div>
        </>
    );
};

export default Search;
