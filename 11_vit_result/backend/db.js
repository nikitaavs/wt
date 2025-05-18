const mysql = require('mysql2');
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'nikhil2004', // Your MySQL password
  database: 'vit_result_2'
});
connection.connect((err) => {
  if (err) throw err;
  console.log('MySQL Connected!');
});
module.exports = connection;
