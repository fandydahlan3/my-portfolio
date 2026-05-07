import React, { useState, useEffect } from 'react';
import axios from 'axios';

// --- 1. KOMPONEN LOGIN PANEL ---
const LoginPanel = ({ setAuth }) => {
  const [password, setPassword] = useState('');

  const handleLogin = async (e) => {
    e.preventDefault();
    try {
      const res = await axios.post('http://localhost:5000/api/login', { password });
      localStorage.setItem('token', res.data.token);
      setAuth(true);
    } catch (err) {
      alert("Password Salah!");
    }
  };

  return (
    <div className="h-screen flex items-center justify-center bg-gray-950 text-white font-sans">
      <form onSubmit={handleLogin} className="bg-gray-900 p-8 rounded-2xl border border-white/10 shadow-2xl w-80 text-center">
        <h2 className="text-2xl font-bold mb-6 text-kuning-fandy uppercase tracking-widest">Admin Login</h2>
        <input 
          type="password" 
          placeholder="Masukkan Password" 
          className="w-full p-3 bg-gray-800 rounded-xl mb-4 outline-none focus:ring-2 focus:ring-kuning-fandy text-center text-white"
          onChange={(e) => setPassword(e.target.value)} 
          required 
        />
        <button className="w-full bg-kuning-fandy text-black py-2 rounded-xl font-bold hover:brightness-110 transition-all uppercase">
          Masuk
        </button>
      </form>
    </div>
  );
};

// --- 2. KOMPONEN UTAMA ADMIN ---
const Admin = () => {
  const [isAuthenticated, setIsAuthenticated] = useState(false);
  const [projects, setProjects] = useState([]);
  const [skills, setSkills] = useState([]);
  const [form, setForm] = useState({ title: '', category: '', image: '', description: '', tech_stack: '', project_url: '' });
  const [formSkill, setFormSkill] = useState({ name: '', image_url: '' });

  // Fungsi helper untuk ambil token terbaru tiap kali request
  const getAuthHeader = () => ({
    headers: { Authorization: localStorage.getItem('token') }
  });

  const refreshData = () => {
    axios.get('http://localhost:5000/api/projects').then(res => setProjects(res.data)).catch(err => console.log(err));
    axios.get('http://localhost:5000/api/skills').then(res => setSkills(res.data)).catch(err => console.log(err));
  };

  useEffect(() => {
    const token = localStorage.getItem('token');
    if (token) setIsAuthenticated(true);
    refreshData();
  }, []);

  const handleLogout = () => {
    localStorage.removeItem('token');
    setIsAuthenticated(false);
  };

  const handleProjectSubmit = async (e) => {
    e.preventDefault();
    try {
      await axios.post('http://localhost:5000/api/projects', form, getAuthHeader());
      alert("Proyek Berhasil Ditambah!");
      setForm({ title: '', category: '', image: '', description: '', tech_stack: '', project_url: '' });
      refreshData();
    } catch (err) {
      alert("Gagal tambah proyek! Sesi mungkin habis, silakan relogin.");
    }
  };

  const handleSkillSubmit = async (e) => {
    e.preventDefault();
    try {
      await axios.post('http://localhost:5000/api/skills', formSkill, getAuthHeader());
      alert("Skill Berhasil Ditambah!");
      setFormSkill({ name: '', image_url: '' });
      refreshData();
    } catch (err) {
      alert("Gagal tambah skill!");
    }
  };

  const deleteProject = async (id) => {
    if (window.confirm("Hapus proyek ini?")) {
      await axios.delete(`http://localhost:5000/api/projects/${id}`, getAuthHeader());
      refreshData();
    }
  };

  const deleteSkill = async (id) => {
    if (window.confirm("Hapus skill ini?")) {
      await axios.delete(`http://localhost:5000/api/skills/${id}`, getAuthHeader());
      refreshData();
    }
  };

  // Tampilan jika belum login
  if (!isAuthenticated) return <LoginPanel setAuth={setIsAuthenticated} />;

  // Tampilan Dashboard Admin
  return (
    <div className="p-10 bg-gray-950 min-h-screen text-white space-y-12 font-sans relative">
      <button 
        onClick={handleLogout} 
        className="absolute top-5 right-10 bg-red-600/20 text-red-500 border border-red-500/50 px-4 py-2 rounded-lg hover:bg-red-600 hover:text-white transition-all font-bold"
      > 
        LOGOUT 
      </button>

      <div className="max-w-4xl mx-auto">
        <h1 className="text-3xl font-bold mb-10 text-kuning-fandy text-center uppercase tracking-widest">Admin Panel</h1>

        {/* --- FORM PROYEK --- */}
        <form onSubmit={handleProjectSubmit} className="bg-gray-900 p-8 rounded-2xl shadow-xl mb-10 space-y-4 border border-white/10">
          <h2 className="text-xl font-bold mb-4 border-l-4 border-kuning-fandy pl-3 text-white text-left">Tambah Proyek</h2>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4 text-black">
            <input type="text" placeholder="Nama Proyek" className="p-3 bg-gray-800 rounded-xl outline-none focus:ring-2 focus:ring-kuning-fandy text-white" value={form.title} onChange={e => setForm({...form, title: e.target.value})} required />
            <input type="text" placeholder="Kategori" className="p-3 bg-gray-800 rounded-xl outline-none focus:ring-2 focus:ring-kuning-fandy text-white" value={form.category} onChange={e => setForm({...form, category: e.target.value})} required />
          </div>
          <input type="text" placeholder="Link Gambar (/images/foto.jpg)" className="w-full p-3 bg-gray-800 rounded-xl outline-none focus:ring-2 focus:ring-kuning-fandy text-white" value={form.image} onChange={e => setForm({...form, image: e.target.value})} />
          <input type="text" placeholder="Tech Stack (React, MySQL, dll)" className="w-full p-3 bg-gray-800 rounded-xl outline-none focus:ring-2 focus:ring-kuning-fandy text-white" value={form.tech_stack} onChange={e => setForm({...form, tech_stack: e.target.value})} />
          <input type="text" placeholder="Link Proyek / GitHub URL" className="w-full p-3 bg-gray-800 rounded-xl outline-none focus:ring-2 focus:ring-kuning-fandy text-white" value={form.project_url} onChange={e => setForm({...form, project_url: e.target.value})} />
          <textarea placeholder="Deskripsi Singkat" className="w-full p-3 bg-gray-800 rounded-xl h-24 outline-none focus:ring-2 focus:ring-kuning-fandy text-white" value={form.description} onChange={e => setForm({...form, description: e.target.value})} required></textarea>
          <button type="submit" className="w-full bg-kuning-fandy text-black py-3 rounded-xl font-bold hover:brightness-110 transition-all uppercase">Simpan Proyek</button>
        </form>

        {/* --- FORM SKILLS --- */}
        <form onSubmit={handleSkillSubmit} className="bg-gray-900 p-8 rounded-2xl shadow-xl space-y-4 border border-white/10">
          <h2 className="text-xl font-bold mb-4 border-l-4 border-blue-500 pl-3 text-white text-left">Tambah Skill Baru</h2>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" placeholder="Nama Skill" className="p-3 bg-gray-800 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 text-white" value={formSkill.name} onChange={e => setFormSkill({...formSkill, name: e.target.value})} required />
            <input type="text" placeholder="Link Ikon (/images/logo.png)" className="p-3 bg-gray-800 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 text-white" value={formSkill.image_url} onChange={e => setFormSkill({...formSkill, image_url: e.target.value})} required />
          </div>
          <button type="submit" className="w-full bg-blue-600 text-white py-3 rounded-xl font-bold hover:brightness-110 transition-all uppercase">Simpan Skill</button>
        </form>

        {/* --- DAFTAR DATA (MANAGE) --- */}
        <div className="mt-12 bg-gray-900 p-8 rounded-2xl border border-white/10 space-y-8 shadow-2xl text-left">
          <div>
            <h3 className="text-lg font-bold mb-4 text-gray-400 uppercase tracking-wider">Proyek Aktif</h3>
            <div className="grid grid-cols-1 gap-3">
              {projects.map(p => (
                <div key={p.id} className="flex justify-between items-center bg-white/5 p-4 rounded-xl border border-white/5 hover:bg-white/10 transition-all">
                  <span className="font-medium">{p.title}</span>
                  <button onClick={() => deleteProject(p.id)} className="text-red-500 hover:text-red-400 font-bold underline text-sm">Hapus</button>
                </div>
              ))}
            </div>
          </div>
          <div>
            <h3 className="text-lg font-bold mb-4 text-gray-400 uppercase tracking-wider">Skills Aktif</h3>
            <div className="flex flex-wrap gap-3">
              {skills.map(s => (
                <div key={s.id} className="bg-blue-900/30 px-4 py-2 rounded-full flex gap-3 border border-blue-500/30 items-center">
                  <span className="text-sm font-semibold">{s.name}</span>
                  <button onClick={() => deleteSkill(s.id)} className="text-red-400 hover:text-white font-bold">✕</button>
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Admin;
