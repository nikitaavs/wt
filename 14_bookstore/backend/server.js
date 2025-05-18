// backend/server.js
const express = require('express');
const cors = require('cors');
const app = express();

const booksRoute = require('./routes/books');

app.use(cors());
app.use('/books', booksRoute);

app.listen(5000, () => {
  console.log(' Backend server running on http://localhost:8888');
});
