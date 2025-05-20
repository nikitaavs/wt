import React, { useState } from 'react';
import axios from 'axios';

export default function Register() {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');

  const register = () => {
    axios.post('http://localhost:5000/register', { username, password })
      .then(res => alert(res.data))
      .catch(() => alert('Registration failed'));
  };

  return (
    <div>
      <h2>Register</h2>
      <input placeholder="Username" onChange={e => setUsername(e.target.value)} /><br />
      <input type="password" placeholder="Password" onChange={e => setPassword(e.target.value)} /><br />
      <button onClick={register}>Register</button>
    </div>
  );
}
