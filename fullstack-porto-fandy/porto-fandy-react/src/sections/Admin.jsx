import React, { useState } from 'react';
import { useAdminlogic } from '../hooks/useAdminlogic';
import { simpanProyek, hapusProyek, hapusSkill } from '../api/adminApi';

function Admin() {
  const { listKarya, listSkill, sedangMemuat, sinkronisasiData } = useAdminLogic();
  
  const [fromProyek, setFromProyek] = useState({
    title: '', category: '', image: '', tech_stack: '', projeect_url: '', description: ''
  });

  // PERBAIKAN 1: Ganti 'nam' jadi 'name' biar sama kayak database kamu
  const [fromSkill, setFromSkill] = useState({ name: '', image_url: '' });
  const [idEdit, setIdEdit] = useState(null);

  function keluarSistem() {
    if (window.confirm("Keluar dari Admin Panel?")) {
      localStorage.removeItem('token');
      window.location.reload();
    }
  }

  async function tanganiSimpanProyek(e) {
    e.preventDefault();
    try {
      await simpanProyek(fromProyek, idEdit);
      setFromProyek({ title: '', category: '', image: '', tech_stack: '', projeect_url: '', description: '' });
      setIdEdit(null);
      sinkronisasiData();
      alert("Proyek Berhasil Disimpan!");
    } catch (err) { alert("Gagal menyimpan proyek!"); }
  }

  async function tanganiSimpanSkill(e) {
    e.preventDefault();
    try {
      // PERBAIKAN 2: Kirim fromSkill (yg udah pake key 'name')
      await simpanProyek(fromSkill, null, true); 
      setFromSkill({ name: '', image_url: '' });
      sinkronisasiData();
      alert("Skill Berhasil Ditambah!");
    } catch (err) { alert("Gagal menyimpan skill!"); }
  }

  return (
    <div className="p-10 bg-[#0a0f1a] min-h-screen text-white space-y-12 font-sans relative text-left">
      <button onClick={keluarSistem} className="absolute top-5 right-10 bg-red-600/20 text-red-500 border border-red-500/50 px-4 py-2 rounded-lg hover:bg-red-600 hover:text-white transition-all font-bold uppercase text-xs"> LOGOUT </button>
      
      <div className="max-w-4xl mx-auto space-y-10">
        <h1 className="text-3xl font-black text-center text-yellow-500 uppercase tracking-widest">ADMIN PANEL</h1>

        {/* --- FORM PROYEK --- */}
        <form onSubmit={tanganiSimpanProyek} className={`p-8 rounded-2xl shadow-xl space-y-4 border ${idEdit ? 'bg-blue-900/20 border-blue-500/50' : 'bg-[#111827] border-white/10'}`}>
          <h2 className="text-xl font-bold border-l-4 border-yellow-500 pl-3 mb-4">{idEdit ? 'EDIT PROYEK' : 'TAMBAH PROYEK'}</h2>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" placeholder='Nama Proyek' className="p-3 bg-[#1f2937] rounded-xl outline-none" value={fromProyek.title} onChange={e => setFromProyek({...fromProyek, title: e.target.value})} required />
            <select className="p-3 bg-[#1f2937] rounded-xl outline-none text-gray-400 font-bold" value={fromProyek.category} onChange={e => setFromProyek({...fromProyek, category: e.target.value})}>
              <option value="">Pilih Kategori</option>
              <option value="Web Development">Web Development</option>
              <option value="Data Science">Data Science</option>
            </select>
          </div>
          <input type="text" placeholder='Link Gambar' className="w-full p-3 bg-[#1f2937] rounded-xl outline-none" value={fromProyek.image} onChange={e => setFromProyek({...fromProyek, image: e.target.value})} />
          <input type="text" placeholder='Tech Stack' className="w-full p-3 bg-[#1f2937] rounded-xl outline-none" value={fromProyek.tech_stack} onChange={e => setFromProyek({...fromProyek, tech_stack: e.target.value})} />
          <input type="text" placeholder='URL Live' className="w-full p-3 bg-[#1f2937] rounded-xl outline-none" value={fromProyek.projeect_url} onChange={e => setFromProyek({...fromProyek, projeect_url: e.target.value})} />
          <textarea placeholder='Deskripsi' className="w-full p-3 bg-[#1f2937] rounded-xl outline-none h-28 resize-none text-white" value={fromProyek.description} onChange={e => setFromProyek({...fromProyek, description: e.target.value})}></textarea>
          <button type="submit" className="w-full py-4 bg-yellow-500 text-black font-black rounded-xl hover:bg-yellow-400 uppercase tracking-widest transition-all shadow-lg shadow-yellow-500/10"> {idEdit ? 'UPDATE DATA' : 'SIMPAN PROYEK'} </button>
        </form>

        {/* --- FORM SKILL --- */}
        <form onSubmit={tanganiSimpanSkill} className="p-8 bg-[#111827] rounded-2xl border border-white/10 shadow-xl space-y-4">
          <h2 className="text-xl font-bold border-l-4 border-blue-500 pl-3 mb-4 uppercase text-white">Tambah Skill</h2>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" placeholder='Nama Skill' className="p-3 bg-[#1f2937] rounded-xl text-white outline-none" value={fromSkill.name} onChange={e => setFromSkill({...fromSkill, name: e.target.value})} required />
            <input type="text" placeholder='Link Ikon (/images/node.png)' className="p-3 bg-[#1f2937] rounded-xl text-white outline-none" value={fromSkill.image_url} onChange={e => setFromSkill({...fromSkill, image_url: e.target.value})} required />
          </div>
          <button type="submit" className="w-full py-4 bg-blue-600 text-white font-black rounded-xl hover:bg-blue-500 uppercase tracking-widest transition-all"> SIMPAN SKILL </button>
        </form>

        {/* --- MANAGE DATA --- */}
        <div className="space-y-8">
          {/* Skill Aktif */}
          <div className="p-8 bg-[#111827]/50 rounded-2xl border border-white/10 shadow-inner">
            <h3 className="text-[10px] font-bold text-gray-500 mb-6 uppercase tracking-[0.3em]">Skill Aktif</h3>
            <div className="flex flex-wrap gap-5">
              {listSkill.length === 0 ? (
                <p className="text-gray-600 italic text-sm">Belum ada skill.</p>
              ) : (
                listSkill.map((s) => (
                  <div key={s.id} className="relative group bg-[#0a0f1a] p-2 rounded-xl border border-white/5 hover:border-blue-500/50 transition-all">
                    {/* PERBAIKAN 3: Pake s.image_url dan s.name (sesuai database) */}
                    <img src={s.image_url} alt={s.name} className="w-10 h-10 object-contain p-1" onError={(e) => {e.target.src="https://placeholder.com?"}} />
                    <span className="block text-[8px] text-center mt-1 text-gray-400 uppercase font-bold">{s.name}</span>
                    <button onClick={() => { if (window.confirm(`Hapus ${s.name}?`)) { hapusSkill(s.id); sinkronisasiData(); } }} className="absolute -top-2 -right-2 bg-red-600 text-white w-5 h-5 rounded-full text-[10px] flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow-lg" >✕</button>
                  </div>
                ))
              )}
            </div>
          </div>

          {/* Proyek Aktif */}
          <div className="p-8 bg-[#111827]/50 rounded-2xl border border-white/10">
            <h3 className="text-[10px] font-bold text-gray-500 mb-6 uppercase tracking-[0.3em]">Koleksi Proyek Saya</h3>
            <div className="space-y-4">
              {sedangMemuat ? ( <p className="text-gray-500 italic text-center py-4">Memuat data...</p> ) : (
                listKarya.map((item) => (
                  <div key={item.id} className="flex justify-between items-center p-5 bg-[#0a0f1a]/60 rounded-2xl border border-white/5 hover:border-yellow-500/20 transition-all">
                    <div>
                      <p className="font-bold text-gray-200 text-sm uppercase tracking-tight">{item.title}</p>
                      <span className="text-[9px] text-gray-600 uppercase font-black">{item.category}</span>
                    </div>
                    <div className="flex gap-4 text-[10px] font-black uppercase tracking-tighter">
                      <button onClick={() => { setIdEdit(item.id); setFromProyek(item); window.scrollTo({ top: 0, behavior: 'smooth' }); }} className="text-blue-500">Edit</button>
                      <button onClick={() => { if (window.confirm('Hapus proyek?')) { hapusProyek(item.id); sinkronisasiData(); } }} className="text-red-600">Hapus</button>
                    </div>
                  </div>
                ))
              )}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Admin;
