import React, { useEffect, useState } from 'react';
import axios from 'axios';

export default function Catalogue() {
  const [books, setBooks] = useState([]);

  useEffect(() => {
    axios.get('http://localhost:5000/books')
      .then(res => setBooks(res.data))
      .catch(err => console.error(err));
  }, []);

  return (
    <div>
      <h2>Book Catalogue</h2>
      <ul>
        {books.map(book => (
          <li key={book.id}>
            {book.title} by {book.author} - ${book.price}
          </li>
        ))}
      </ul>
    </div>
  );
}
