const mysql = require('mysql2');

const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',      // User default XAMPP
  password: '',      // Password default XAMPP biasanya kosong
  database: 'spk_climbing' 
});

db.connect((err) => {
  if (err) {
    console.error('Koneksi Gagal:', err.message);
  } else {
    console.log('Terhubung ke database MySQL!');
  }
});

module.exports = db;
