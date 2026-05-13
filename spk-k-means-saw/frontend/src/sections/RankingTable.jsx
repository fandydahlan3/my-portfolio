import React, { useState, useEffect } from 'react';
import { Timer, Mountain, Award, ChevronRight, Filter } from 'lucide-react';

const RankingTable = () => {
  // 1. Definisikan state filter lokal dan penampung data
  const [bulan, setBulan] = useState(5); // Default Bulan Mei sesuai database Anda
  const [tahun, setTahun] = useState(2026); // Default Tahun 2026
  const [rankingData, setRankingData] = useState([]);
  const [loading, setLoading] = useState(false);

  // 2. Fungsi fetch data dinamis dengan parameter filter
  const fetchRankingTerfilter = async () => {
    setLoading(true);
    try {
      const response = await fetch(`http://localhost:5000/api/proses-spk?bulan=${bulan}&tahun=${tahun}`);
      const result = await response.json();
      
      if (result && !result.error) {
        setRankingData(result);
      } else {
        alert(result.error || "Gagal memproses data peringkat.");
        setRankingData([]);
      }
    } catch (error) {
      console.error("Koneksi ke backend gagal:", error);
      setRankingData([]);
    } finally {
      setLoading(false);
    }
  };

  // Jalankan pencarian otomatis saat halaman pertama kali dibuka
  useEffect(() => {
    fetchRankingTerfilter();
  }, []);

  // 3. Klasifikasikan kategori atlet berdasarkan data lokal terfilter
  const speedAthletes = rankingData.filter(item => item.kategori === "Speed Specialist");
  const leadAthletes = rankingData.filter(item => item.kategori === "Lead Specialist");

  const MiniTable = ({ title, icon, color, athletes }) => (
    <div className="bg-white rounded-[24px] shadow-xl border border-slate-200 overflow-hidden flex-1 flex flex-col">
      {/* Header Tabel */}
      <div className={`p-6 flex justify-between items-center bg-gradient-to-br ${color} text-white`}>
        <div className="flex items-center gap-3">
          <div className="bg-white/20 p-2.5 rounded-xl backdrop-blur-md border border-white/20">
            {icon}
          </div>
          <div>
            <h3 className="font-bold text-base leading-none">{title}</h3>
            <p className="text-[9px] opacity-70 uppercase tracking-widest mt-1 font-bold">Top Rank SAW</p>
          </div>
        </div>
        <Award size={20} className="opacity-40" />
      </div>

      {/* Body Tabel */}
      <div className="p-4 flex-1">
        {athletes.length === 0 ? (
          <div className="text-center py-12 text-slate-400 text-xs italic">
            Tidak ada data atlet pada periode ini.
          </div>
        ) : (
          <table className="w-full border-separate border-spacing-y-2">
            <thead>
              <tr className="text-slate-400 text-[9px] uppercase tracking-tighter font-black">
                <th className="px-3 py-2 text-left w-12">Rank</th>
                <th className="px-3 py-2 text-left">Nama Atlet</th>
                <th className="px-3 py-2 text-center">Skor</th>
                <th className="px-3 py-2 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody>
              {athletes.map((item, index) => (
                <tr key={item.id} className="group hover:bg-slate-50 transition-all duration-200">
                  <td className="px-3 py-3 bg-slate-50/50 border-y border-l border-slate-100 first:rounded-l-xl">
                    <div className={`w-8 h-8 rounded-lg flex items-center justify-center font-bold text-xs ${
                      index === 0 ? 'bg-yellow-500 text-white shadow-md' : 'bg-white text-slate-400'
                    }`}>
                      {index + 1}
                    </div>
                  </td>
                  <td className="px-3 py-3 bg-slate-50/50 border-y border-slate-100">
                    <p className="font-bold text-slate-700 text-xs truncate max-w-[100px]">{item.nama_atlet}</p>
                    <p className="text-[9px] text-slate-400 italic">
                      Periode: {item.bulan}/{item.tahun}
                    </p>
                  </td>
                  <td className="px-3 py-3 bg-slate-50/50 border-y border-slate-100 text-center">
                    <span className="text-blue-600 font-black text-sm">{item.skor_saw}</span>
                  </td>
                  <td className="px-3 py-3 bg-slate-50/50 border-y border-r border-slate-100 text-right last:rounded-r-xl">
                    <button className="p-1.5 hover:bg-white rounded-lg transition-colors text-slate-300 hover:text-blue-600">
                      <ChevronRight size={16} />
                    </button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        )}
      </div>
      <div className="p-4 bg-slate-50/50 border-t border-slate-100 text-center">
        <button className="text-[10px] font-bold text-blue-600 hover:underline uppercase tracking-widest">
          Lihat Analisis Lengkap
        </button>
      </div>
    </div>
  );

  return (
    <div className="flex flex-col gap-6 w-full">
      
      {/* AREA COMPONENT FILTER PERIODE BULAN & TAHUN */}
      <div className="bg-white p-4 rounded-[20px] shadow-md border border-slate-100 flex flex-wrap items-center gap-4">
        <div className="flex items-center gap-2 text-slate-700 font-bold text-xs uppercase tracking-wider">
          <Filter size={16} className="text-blue-600" />
          <span>Filter Periode:</span>
        </div>

        {/* Dropdown Bulan */}
        <div className="flex flex-col gap-1">
          <select 
            value={bulan} 
            onChange={(e) => setBulan(Number(e.target.value))}
            className="bg-slate-50 border border-slate-200 text-slate-700 text-xs rounded-xl p-2.5 font-medium outline-none focus:border-blue-500 transition-colors"
          >
            <option value="1">Januari</option>
            <option value="2">Februari</option>
            <option value="3">Maret</option>
            <option value="4">April</option>
            <option value="5">Mei</option>
            <option value="6">Juni</option>
            <option value="7">Juli</option>
            <option value="8">Agustus</option>
            <option value="9">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
          </select>
        </div>

        {/* Dropdown Tahun */}
        <div className="flex flex-col gap-1">
          <select 
            value={tahun} 
            onChange={(e) => setTahun(Number(e.target.value))}
            className="bg-slate-50 border border-slate-200 text-slate-700 text-xs rounded-xl p-2.5 font-medium outline-none focus:border-blue-500 transition-colors"
          >
            <option value="2025">2025</option>
            <option value="2026">2026</option>
            <option value="2027">2027</option>
          </select>
        </div>

        {/* Tombol Eksekusi */}
        <button
          onClick={fetchRankingTerfilter}
          disabled={loading}
          className="bg-blue-600 hover:bg-blue-700 disabled:bg-slate-300 text-white text-xs font-bold px-5 py-2.5 rounded-xl shadow-md shadow-blue-500/10 active:scale-95 transition-all"
        >
          {loading ? "Memproses..." : "Cari Peringkat"}
        </button>
      </div>

      {/* SEKSI CARD VISUAL TABEL UTAMA */}
      <div className="flex flex-col lg:flex-row gap-8 w-full items-stretch">
        <MiniTable title="Kategori Speed" icon={<Timer size={20}/>} color="from-orange-500 to-red-600" athletes={speedAthletes} type="speed" />
        <MiniTable title="Kategori Lead" icon={<Mountain size={20}/>} color="from-blue-600 to-indigo-700" athletes={leadAthletes} type="lead" />
      </div>

    </div>
  );
};

export default RankingTable;
