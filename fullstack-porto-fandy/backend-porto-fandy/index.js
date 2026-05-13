{/* --- AREA SKILL AKTIF --- */}
<div className="mt-10 p-8 bg-gray-900/30 rounded-2xl border border-white/10">
  <h3 className="text-xs font-bold text-gray-500 mb-6 uppercase tracking-widest">Skill Aktif</h3>
  <div className="flex flex-wrap gap-4">
    {listSkill && listSkill.length > 0 ? (
      listSkill.map((s) => (
        <div key={s.id} className="relative group bg-gray-800 p-3 rounded-xl border border-white/5 flex flex-col items-center min-w-[80px]">
          {/* Menampilkan Gambar */}
          <img 
            src={s.image_url} 
            alt={s.name} 
            className="w-10 h-10 object-contain mb-2" 
            onError={(e) => { e.target.src = "https://placeholder.com?" }} 
          />
          {/* Pakai s.name (BUKAN s.nam) */}
          <span className="text-[10px] font-bold text-blue-400 uppercase text-center">{s.name}</span>
          
          {/* Tombol Hapus */}
          <button 
            onClick={() => { if (window.confirm(`Hapus ${s.name}?`)) { hapusSkill(s.id); sinkronisasiData(); } }}
            className="absolute -top-2 -right-2 bg-red-600 text-white w-5 h-5 rounded-full text-[10px] flex items-center justify-center shadow-lg"
          >✕</button>
        </div>
      ))
    ) : (
      <p className="text-gray-600 italic text-sm">Belum ada skill di database.</p>
    )}
  </div>
</div>
