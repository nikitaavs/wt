// ==== FRONTEND FILES (React) ====

// /client/public/index.html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>VIT Semester Result</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div id="root"></div>
</body>
</html>


// /client/src/index.js
import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './App';

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(<App />);


// /client/src/App.js
import React, { useEffect, useState } from 'react';
import StudentForm from './components/StudentForm';
import ResultTable from './components/ResultTable';
import axios from 'axios';

function App() {
  const [students, setStudents] = useState([]);

  const fetchStudents = async () => {
    const res = await axios.get('http://localhost:3001/api/results');
    setStudents(res.data);
  };

  useEffect(() => {
    fetchStudents();
  }, []);

  const handleAddStudent = async (student) => {
    await axios.post('http://localhost:3001/api/results', student);
    fetchStudents();
  };

  return (
    <div className="container mt-4">
      <h1 className="text-center mb-4">VIT Semester Result Portal</h1>
      <StudentForm onAddStudent={handleAddStudent} />
      <hr />
      <ResultTable students={students} />
    </div>
  );
}

export default App;


// /client/src/components/StudentForm.js
import React, { useState } from 'react';

function StudentForm({ onAddStudent }) {
  const [formData, setFormData] = useState({
    name: '',
    roll: '',
    subject1_mse: '', subject1_ese: '',
    subject2_mse: '', subject2_ese: '',
    subject3_mse: '', subject3_ese: '',
    subject4_mse: '', subject4_ese: ''
  });

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData(prev => ({ ...prev, [name]: value }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    onAddStudent(formData);
    setFormData({
      name: '', roll: '',
      subject1_mse: '', subject1_ese: '',
      subject2_mse: '', subject2_ese: '',
      subject3_mse: '', subject3_ese: '',
      subject4_mse: '', subject4_ese: ''
    });
  };

  return (
    <form onSubmit={handleSubmit}>
      <div className="row mb-3">
        <div className="col">
          <input type="text" className="form-control" name="name" value={formData.name} onChange={handleChange} placeholder="Student Name" required />
        </div>
        <div className="col">
          <input type="text" className="form-control" name="roll" value={formData.roll} onChange={handleChange} placeholder="Roll Number" required />
        </div>
      </div>
      {[1, 2, 3, 4].map(i => (
        <div className="row mb-2" key={i}>
          <div className="col">
            <input type="number" className="form-control" name={`subject${i}_mse`} value={formData[`subject${i}_mse`]} onChange={handleChange} placeholder={`Subject ${i} MSE (30)`} required />
          </div>
          <div className="col">
            <input type="number" className="form-control" name={`subject${i}_ese`} value={formData[`subject${i}_ese`]} onChange={handleChange} placeholder={`Subject ${i} ESE (70)`} required />
          </div>
        </div>
      ))}
      <button type="submit" className="btn btn-primary mt-3">Submit</button>
    </form>
  );
}

export default StudentForm;


// /client/src/components/ResultTable.js
import React from 'react';

function ResultTable({ students }) {
  const calc = (m, e) => ((m * 0.3) + (e * 0.7)).toFixed(2);

  return (
    <div className="mt-4">
      <h4>Results</h4>
      <table className="table table-bordered">
        <thead>
          <tr>
            <th>Name</th><th>Roll</th>
            {[1, 2, 3, 4].map(i => <th key={i}>Sub{i}</th>)}
          </tr>
        </thead>
        <tbody>
          {students.map((s, idx) => (
            <tr key={idx}>
              <td>{s.name}</td>
              <td>{s.roll}</td>
              {[1,2,3,4].map(i => (
                <td key={i}>{calc(s[`subject${i}_mse`], s[`subject${i}_ese`])}</td>
              ))}
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}

export default ResultTable;
