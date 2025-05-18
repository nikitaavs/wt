// backend/db.js
//database- bookstore php
const mysql = require('mysql');

const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'nikhil2004', // use your MAMP MySQL password here (default is empty)
  database: 'bookstore'
});

db.connect(err => {
  if (err) throw err;
  console.log('✅ MySQL connected!');
});

module.exports = db;
