import React, { useState } from 'react';
import { LogIn, User, Lock, BarChart3 } from 'lucide-react';

const Login = ({ onLogin }) => {
  const [credentials, setCredentials] = useState({ username: '', password: '' });

  const handleLogin = async (e) => {
    e.preventDefault();
    try {
      const response = await fetch('http://localhost:5000/api/auth/signin', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(credentials)
      });
      const data = await response.json();
      
      if (data.success) {
        // PERBAIKAN VITAL: Kirim objek data utuh (bukan hanya data.profil)
        // agar properti data.token terekstrak dengan sukses di App.jsx
        onLogin(data); 
      } else {
        alert(data.pesan || "Login Gagal");
      }
    } catch (error) {
      alert("Gagal terhubung ke server!");
    }
  };

  return (
    <div className="min-h-screen bg-[#0F172A] flex items-center justify-center p-6">
      <div className="bg-white w-full max-w-md rounded-[40px] p-10 shadow-2xl">
        <div className="text-center mb-10">
          <div className="bg-blue-600 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-blue-500/30">
            <BarChart3 className="text-white" size={32} />
          </div>
          <h1 className="text-2xl font-black text-slate-800 italic uppercase">SPK <span className="text-blue-600">PANJAT</span></h1>
          <p className="text-slate-400 text-sm font-medium mt-1">Silakan masuk ke sistem</p>
        </div>

        <form onSubmit={handleLogin} className="space-y-6">
          <div className="space-y-2">
            <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-2">Username</label>
            <div className="relative">
              <User className="absolute left-4 top-4 text-slate-300" size={20} />
              <input 
                type="text" 
                required 
                className="w-full bg-slate-50 border border-slate-200 p-4 pl-12 rounded-2xl outline-none focus:border-blue-500 font-bold" 
                onChange={(e) => setCredentials({...credentials, username: e.target.value})} 
              />
            </div>
          </div>

          <div className="space-y-2">
            <label className="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-2">Password</label>
            <div className="relative">
              <Lock className="absolute left-4 top-4 text-slate-300" size={20} />
              <input 
                type="password" 
                required 
                className="w-full bg-slate-50 border border-slate-200 p-4 pl-12 rounded-2xl outline-none focus:border-blue-500 font-bold"
                onChange={(e) => setCredentials({...credentials, password: e.target.value})} 
              />
            </div>
          </div>

          <button type="submit" className="w-full bg-blue-600 hover:bg-blue-700 text-white py-5 rounded-[24px] font-black shadow-xl shadow-blue-500/30 transition-all flex items-center justify-center gap-3">
            <LogIn size={20} /> MASUK SEKARANG
          </button>
        </form>
      </div>
    </div>
  );
};

export default Login;
