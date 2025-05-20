import React, { useState } from 'react';
import axios from 'axios';

export default function Login() {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');

  const login = () => {
    axios.post('http://localhost:5000/login', { username, password })
      .then(res => alert(res.data))
      .catch(() => alert('Login failed'));
  };

  return (
    <div>
      <h2>Login</h2>
      <input placeholder="Username" onChange={e => setUsername(e.target.value)} /><br />
      <input type="password" placeholder="Password" onChange={e => setPassword(e.target.value)} /><br />
      <button onClick={login}>Login</button>
    </div>
  );
}
