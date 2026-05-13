require('dotenv').config();
const express = require('express');
const mysql = require('mysql2');
const cors = require('cors');
const { spawn } = require('child_process');
const path = require('path');
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');

const app = express();

// Konfigurasi Keamanan CORS Backend
app.use(cors({ origin: 'http://localhost:5173', credentials: true })); 
app.use(express.json());

const JWT_SECRET_KEY = process.env.JWT_SECRET || 'KUNCI_RAHASIA_SUPER_KETAT_SPK';

const KoneksiDB = mysql.createConnection({
    host: process.env.DB_HOST || 'localhost',
    user: process.env.DB_USER || 'root',
    password: process.env.DB_PASS || '',
    database: process.env.DB_NAME || 'spk_climbing'
});

KoneksiDB.connect((problem) => {
    if (problem) {
        console.error('Koneksi database MySQL Gagal: ' + problem.message);
        return;
    }
    console.log('Database MySQL SPK Panjat Berhasil Terhubung!');
});

// MIDDLEWARE PENGAMAN: VERIFIKASI TOKEN JWT FISIK
const verifikasiToken = (req, res, next) => {
    const authHeader = req.headers['authorization'];
    if (!authHeader) {
        return res.status(401).json({ pesan: "Akses ditolak! Header tidak ditemukan." });
    }
    
    const token = authHeader.split(' ')[1]; 
    if (!token) {
        return res.status(401).json({ pesan: "Akses ditolak! Token tidak ditemukan." });
    }

    jwt.verify(token, JWT_SECRET_KEY, (err, decodedUser) => {
        if (err) {
            return res.status(403).json({ pesan: "Token kedaluwarsa atau tidak valid!" });
        }
        req.user = decodedUser;
        next();
    });
};

// =======================================================================
// 1. API AUTHENTICATION SIGNIN
// =======================================================================
app.post('/api/auth/signin', (req, res) => {
    const { username, password } = req.body;
    
    if (!username || !password) {
        return res.status(400).json({ pesan: "Username dan password harus diisi!" });
    }

    const sql = "SELECT * FROM users WHERE username = ? LIMIT 1";
    
    KoneksiDB.query(sql, [username], async (err, hasil) => {
        if (err) return res.status(500).json({ error: "Koneksi DB bermasalah", detail: err.message });
        if (!hasil || hasil.length === 0) return res.status(401).json({ pesan: "Username tidak terdaftar!" });

        try {
            const dataBersih = JSON.parse(JSON.stringify(hasil));
            const user = dataBersih[0];

            if (!user || !user.password) {
                return res.status(401).json({ pesan: "Struktur data user rusak di database!" });
            }

            const match = await bcrypt.compare(password, user.password).catch(() => false);
            const plainMatch = (password === user.password);

            if (match || plainMatch) {
                const tokenDigital = jwt.sign(
                    { id: user.id, username: user.username }, 
                    JWT_SECRET_KEY, 
                    { expiresIn: '2h' }
                );

                return res.json({
                    success: true,
                    token: tokenDigital,
                    profil: { 
                        id: user.id, 
                        nama: user.username, 
                        nama_lengkap: user.nama_lengkap || user.username 
                    }
                });
            } else {
                return res.status(401).json({ pesan: "Kata sandi / Password salah!" });
            }
        } catch (e) {
            console.error("Bcrypt Error:", e);
            return res.status(500).json({ pesan: "Sistem internal error saat verifikasi." });
        }
    });
});

// 2. API SIMPAN ATLET BARU (DIKUNCI JWT)
app.post('/api/atlet', verifikasiToken, (req, res) => {
    const { nama_atlet, c1, c2, c3, c4, c5, c6, c7, c8, c9, c10, bulan, tahun } = req.body;
    if (!nama_atlet) return res.status(400).json({ error: "Nama Atlet wajib diisi!" });

    const sql = "INSERT INTO atlet (nama_atlet, c1, c2, c3, c4, c5, c6, c7, c8, c9, c10, bulan, tahun) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    const values = [nama_atlet, Number(c1)||0, Number(c2)||0, Number(c3)||0, Number(c4)||0, Number(c5)||0, Number(c6)||0, Number(c7)||0, Number(c8)||0, Number(c9)||0, Number(c10)||0, Number(bulan)||1, Number(tahun)||new Date().getFullYear()];

    KoneksiDB.query(sql, values, (problem) => {
        if (problem) return res.status(500).json({ error: problem.message });
        res.send({ success: true, message: "Data atlet berhasil masuk!" });
    });
});

// 3. API UPDATE / EDIT DATA ATLET (DIKUNCI JWT)
app.put('/api/atlet/:id', verifikasiToken, (req, res) => {
    const { id } = req.params;
    const { nama_atlet, c1, c2, c3, c4, c5, c6, c7, c8, c9, c10 } = req.body;

    const sql = `UPDATE atlet SET nama_atlet=?, c1=?, c2=?, c3=?, c4=?, c5=?, c6=?, c7=?, c8=?, c9=?, c10=? WHERE id=?`;
    const values = [nama_atlet, Number(c1)||0, Number(c2)||0, Number(c3)||0, Number(c4)||0, Number(c5)||0, Number(c6)||0, Number(c7)||0, Number(c8)||0, Number(c9)||0, Number(c10)||0, id];

    KoneksiDB.query(sql, values, (problem) => {
        if (problem) return res.status(500).json({ error: problem.message });
        res.send({ success: true, message: "Data atlet berhasil diperbarui!" });
    });
});

// 4. API DELETE / HAPUS ATLET (DIKUNCI JWT)
app.delete('/api/atlet/:id', verifikasiToken, (req, res) => {
    KoneksiDB.query("DELETE FROM atlet WHERE id = ?", [req.params.id], (problem) => {
        if (problem) return res.status(500).json({ error: problem.message });
        res.send({ success: true, message: "Data atlet berhasil dihapus!" });
    });
});

// 5. API PROSES METODE SPK K-MEANS + SAW (DIKUNCI JWT)
app.get('/api/proses-spk', verifikasiToken, (req, res) => {
    const bulan = String(req.query.bulan || "5").replace(/[^0-9]/g, "");
    const tahun = String(req.query.tahun || "2026").replace(/[^0-9]/g, "");

    const scriptpath = path.join(__dirname, 'spk_logic.py');
    const python = spawn('python', [scriptpath, bulan, tahun]);

    let resultData = "";
    let errorData = "";

    python.stdout.on('data', (data) => { resultData += data.toString(); });
    python.stderr.on('data', (data) => { errorData += data.toString(); });

    python.on('close', (code) => {
        if (code !== 0) return res.status(500).json({ error: "Python Error", detail: errorData });
        try {
            const lines = resultData.trim().split('\n');
            res.json(JSON.parse(lines[lines.length - 1]));
        } catch (problem) {
            res.status(500).json({ error: "Gagal memproses JSON", detail: problem.message });
        }
    });
});

// 6. API UPDATE BOBOT KRITERIA
app.post('/api/bobot/:kategori', verifikasiToken, (req, res) => {
    const { kategori } = req.params; 
    const bobotData = req.body; 

    if (kategori !== 'speed' && kategori !== 'lead') {
        return res.status(400).json({ pesan: "Kategori bobot harus 'speed' atau 'lead'!" });
    }

    const kolomTarget = kategori === 'speed' ? 'bobot_speed' : 'bobot_lead';

    const queries = Object.keys(bobotData).map((idKriteria) => {
        return new Promise((resolve, reject) => {
            const sql = `UPDATE kriteria SET ${kolomTarget} = ? WHERE id = ?`;
            const nilaiBobot = Number(bobotData[idKriteria]) || 0;
            
            KoneksiDB.query(sql, [nilaiBobot, idKriteria], (err, hasil) => {
                if (err) return reject(err);
                resolve(hasil);
            });
        });
    });

    Promise.all(queries)
        .then(() => {
            res.json({ success: true, message: `Seluruh bobot kriteria ${kategori} berhasil diperbarui!` });
        })
        .catch((err) => {
            console.error("Gagal update bobot:", err);
            res.status(500).json({ error: "Gagal memperbarui database kriteria", detail: err.message });
        });
});

const PORT = process.env.PORT || 5000;
app.listen(PORT, () => console.log(`Server Secure Backend SPK aktif di port ${PORT}`));
