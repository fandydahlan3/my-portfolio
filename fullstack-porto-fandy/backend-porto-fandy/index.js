require('dotenv').config();
const express = require('express');
const mysql = require('mysql2');
const cors = require('cors');
const jwt = require('jsonwebtoken');

const app = express();
app.use(cors());
app.use(express.json());

// --- LOGIKA LOGIN (Otak yang ngecek password) ---
const PASSWORD_ASLI = "fandy123"; 

app.post('/api/login', (req, res) => {
  const { password } = req.body;
  if (password === PASSWORD_ASLI) {
    const token = jwt.sign({ role: 'admin' }, "RAHASIA_FANDY", { expiresIn: '1h' });
    res.json({ success: true, token });
  } else {
    res.status(401).json({ success: false, message: "Salah!" });
  }
});

// Gunakan pool agar koneksi lebih stabil (Best Practice Engineer)
const db = mysql.createPool({
  host: process.env.DB_HOST || '127.0.0.1',
  port: process.env.DB_PORT || 3307,
  user: process.env.DB_USER || 'root',
  password: process.env.DB_PASS || '',
  database: process.env.DB_NAME || 'db_porto_fandy',
  waitForConnections: true,
  connectionLimit: 10
});

// Cek koneksi
db.getConnection((err) => {
  if (err) return console.error('❌ Database Konek Gagal:', err.message);
  console.log('✅ DATABASE CONNECTED VIA POOL!');
});

// --- API PROJECTS ---
app.get('/api/projects', (req, res) => {
  db.query("SELECT * FROM projects ORDER BY id DESC", (err, result) => {
    if (err) return res.status(500).json({ error: "Gagal mengambil data proyek" });
    res.json(result);
  });
});

// --- API SKILLS ---
app.get('/api/skills', (req, res) => {
  db.query("SELECT * FROM skills", (err, result) => {
    if (err) return res.status(500).json({ error: "Gagal mengambil data skills" });
    res.json(result);
  });
});

// Tambahkan Endpoint baru untuk Testing/Health Check
app.get('/', (req, res) => res.send('Backend Porto Fandy is Running! 🚀'));

const PORT = process.env.PORT || 5000;
app.listen(PORT, () => console.log(`🚀 Server on port ${PORT}`));
