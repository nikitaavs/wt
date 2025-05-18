const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const path = require('path');

const app = express();

// Middleware
app.use(bodyParser.urlencoded({ extended: true }));

// MySQL connection
const connection = mysql.createConnection({
  host: 'localhost',
  port:8889,
  user: 'root',
  password: 'root', // Use your actual MySQL password
  database: 'electricity2'
});

connection.connect((err) => {
  if (err) throw err;
  console.log('✅ Connected to MySQL');
});

// Serve index.html
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'index.html'));
});

// Handle form submission
app.post('/calculate', (req, res) => {
  const { consumer_id, units } = req.body;

  const unitCount = parseFloat(units);
  let amount = 0;

  if (unitCount <= 100) amount = unitCount * 5;
  else if (unitCount <= 200) amount = 100 * 5 + (unitCount - 100) * 7;
  else amount = 100 * 5 + 100 * 7 + (unitCount - 200) * 10;

  const sql = 'INSERT INTO billing1 (consumer_id, units, amount) VALUES (?, ?, ?)';
  connection.query(sql, [consumer_id, units, amount], (err, result) => {
    if (err) {
      console.error(err);
      return res.send('❌ Error: Consumer ID not found in consumer1 table');
    }
    res.send(`<h3>✅ Bill saved successfully!</h3><p>Amount: ₹${amount}</p>`);
  });
});

// Start server
app.listen(3000, () => {
  console.log('🚀 Server running at http://localhost:3000');
});
