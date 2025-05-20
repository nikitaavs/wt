import React from 'react';
import { Link } from 'react-router-dom';

export default function Home() {
  return (
    <div>
      <h1>Welcome to Book Store</h1>
      <Link to="/login">Login</Link> | 
      <Link to="/register">Register</Link> | 
      <Link to="/catalogue">Catalogue</Link>
    </div>
  );
}
