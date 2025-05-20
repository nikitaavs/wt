const express = require('express');
const cors = require('cors');
const conn = require('./db');
const app = express();

app.use(cors());
app.use(express.json());

// Register
app.post('/register', (req, res) => {
  const { username, password } = req.body;
  conn.query('INSERT INTO users (username, password) VALUES (?, ?)', [username, password], err => {
    if (err) return res.status(500).send('Error registering user');
    res.send('Registered successfully');
  });
});

// Login
app.post('/login', (req, res) => {
  const { username, password } = req.body;
  conn.query('SELECT * FROM users WHERE username=? AND password=?', [username, password], (err, result) => {
    if (err) return res.status(500).send('Login error');
    if (result.length > 0) res.send('Login successful');
    else res.status(401).send('Invalid credentials');
  });
});

// Get Books
app.get('/books', (req, res) => {
  conn.query('SELECT * FROM books', (err, result) => {
    if (err) return res.status(500).send('Error fetching books');
    res.json(result);
  });
});

app.listen(5000, () => console.log('Server running on port 5000'));
