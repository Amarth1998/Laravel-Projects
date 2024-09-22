import React from 'react'


const Home = () => {
  let user =JSON.parse(localStorage.getItem('user-info'))
  return (
    <div className=' headerbg  ' >
      <h1>Welcome</h1>
  
      {
         localStorage.getItem('user-info')? <><h1>Welcome {user && user.name}</h1></>:null
      }
      
    </div>
  )
}

export default Home
