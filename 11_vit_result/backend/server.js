const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');
const db = require('./db');

const app = express();
app.use(cors());
app.use(bodyParser.json());

app.post('/api/submit', (req, res) => {
  const { studentId, name, subjects, mseMarks, eseMarks } = req.body;
  const finalMarks = subjects.map((sub, i) => ({
    subject: sub,
    mse: mseMarks[i],
    ese: eseMarks[i],
    final: (mseMarks[i] * 0.3 + eseMarks[i] * 0.7).toFixed(2)
  }));

  db.query('INSERT INTO students (id, name) VALUES (?, ?)', [studentId, name], (err) => {
    if (err) return res.status(500).send(err);

    mseMarks.forEach((m, i) => {
      db.query('INSERT INTO mse (student_id, subject, marks) VALUES (?, ?, ?)', [studentId, subjects[i], m]);
    });

    eseMarks.forEach((e, i) => {
      db.query('INSERT INTO ese (student_id, subject, marks) VALUES (?, ?, ?)', [studentId, subjects[i], e]);
    });

    res.json({ name, studentId, finalMarks });
  });
});

app.listen(5000, () => console.log('Server running on http://localhost:5000'));
