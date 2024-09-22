import React, { useEffect, useState } from "react";
import { Table } from "react-bootstrap";
import { useNavigate } from 'react-router-dom';
const Productlist = () => {
    const navigate = useNavigate();
  
  const [data, setData] = useState([]);

  useEffect(() => {
    getData(); // Fetch the data when the component loads
  }, []);

  const goUpdatepage=(id)=>{
    navigate("/update/"+id)
}
  // Function to fetch product data
  async function getData() {
    try {
      let result = await fetch("http://127.0.0.1:8000/api/list");
      result = await result.json(); // Parse the response as JSON
      setData(result); // Set the fetched data in state
    } catch (error) {
      console.error("Error fetching product list:", error);
    }
  }
  // Function to handle deletion of a product
  async function deleteOperation(id) {
    try {
      let result = await fetch(`http://127.0.0.1:8000/api/delete/${id}`, {
        method: "DELETE",
      });
      result = await result.json();
      console.warn(result);
      getData(); // Refresh the product list after deletion
    } catch (error) {
      console.error("Error deleting product:", error);
    }
  }
  return (
    <>
      <h1>Product List</h1>
      <div className="col-sm-8 offset-sm-2">
        <Table striped bordered hover variant="dark">
          <thead>
            <tr>
<th>Id</th> <th>Name</th>
  <th>Price</th> <th>Description</th> <th>Image</th> <th>Delete</th><th>Update</th>
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
                  <td><img  src={`http://localhost:8000/${item.filepath}`}  style={{ width: "50px" ,height:"fit-content"}}  alt={item.name}/></td>
                  <td> <button  onClick={() => deleteOperation(item.id)}  className="btn btn-primary " >  Delete</button> </td>

                  <td> <button className="btn btn-primary"  onClick={()=>goUpdatepage(item.id)}> Update</button> </td>

                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="6">No products available</td> {/* Adjust colSpan */}
              </tr>
            )}
          </tbody>
        </Table>
      </div>
    </>
  );
};

export default Productlist;
