import React from 'react';
import { Bell, UserCircle, Calendar } from 'lucide-react'; // Tambah ikon Calendar

const Header = ({ title, subtitle, selectedYear, setSelectedYear }) => {
  return (
    <header className="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-10 sticky top-0 z-20 shadow-sm shrink-0">
      <div>
        <h2 className="text-2xl font-black text-slate-800 tracking-tight leading-none">{title}</h2>
        <p className="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1.5 italic opacity-70">{subtitle}</p>
      </div>

      {/* --- VISUAL BARU: PEMILIH TAHUN --- */}
      <div className="flex items-center gap-3 bg-slate-50 border border-slate-200 px-4 py-2 rounded-2xl group focus-within:border-blue-500 transition-all">
        <Calendar size={18} className="text-slate-400 group-focus-within:text-blue-500" />
        <div className="flex flex-col">
          <label className="text-[9px] font-black text-slate-400 uppercase leading-none mb-0.5">Periode Data</label>
          <select 
            value={selectedYear}
            onChange={(e) => setSelectedYear(e.target.value)}
            className="bg-transparent outline-none text-sm font-black text-blue-600 cursor-pointer"
          >
            <option value="2024">Tahun 2024</option>
            <option value="2025">Tahun 2025</option>
            <option value="2026">Tahun 2026</option>
          </select>
        </div>
      </div>
      
      {/* Bagian Profil (Tetap sama) */}
      <div className="flex items-center gap-6">
        <div className="flex items-center gap-4 pl-6 border-l border-slate-200 text-right">
          <div className="hidden sm:block">
            <p className="text-sm font-black text-slate-800 leading-none">Fandy Ahmad</p>
            <p className="text-[10px] font-bold text-blue-600 uppercase mt-1">Head of Coaches</p>
          </div>
          <div className="w-11 h-11 rounded-2xl bg-blue-600 flex items-center justify-center text-white shadow-lg shadow-blue-600/30 font-bold">FA</div>
        </div>
      </div>
    </header>
  );
};

export default Header;
