import React, { useState } from 'react';
import { Timer, Mountain, Save, AlertCircle } from 'lucide-react';

const CriteriaTable = () => {
  const [speedWeights, setSpeedWeights] = useState([
    { id: "C1", nama: "Kecepatan", bobot: 0.60 },
    { id: "C2", nama: "Power Tungkai", bobot: 0.10 },
    { id: "C3", nama: "Agility", bobot: 0.05 },
    { id: "C4", nama: "An Aerobik", bobot: 0.05 },
    { id: "C5", nama: "Flexibility", bobot: 0.04 },
    { id: "C6", nama: "Daya Tahan Otot Lengan", bobot: 0.04 },
    { id: "C7", nama: "Daya Tahan Aerob", bobot: 0.03 },
    { id: "C8", nama: "Daya Tahan Otot Perut", bobot: 0.03 },
    { id: "C9", nama: "Core Balance", bobot: 0.03 },
    { id: "C10", nama: "Absensi", bobot: 0.03 },
  ]);

  const [leadWeights, setLeadWeights] = useState([
    { id: "C1", nama: "Kecepatan", bobot: 0.13 },
    { id: "C2", nama: "Power Tungkai", bobot: 0.20 },
    { id: "C3", nama: "Agility", bobot: 0.50 },
    { id: "C4", nama: "An Aerobik", bobot: 0.10 },
    { id: "C5", nama: "Flexibility", bobot: 0.13 },
    { id: "C6", nama: "Daya Tahan Otot Lengan", bobot: 0.13 },
    { id: "C7", nama: "Daya Tahan Aerob", bobot: 0.70 },
    { id: "C8", nama: "Daya Tahan Otot Perut", bobot: 0.10 },
    { id: "C9", nama: "Core Balance", bobot: 0.10 },
    { id: "C10", nama: "Absensi", bobot: 0.13 },
  ]);

  const handleSpeedChange = (id, val) => {
    setSpeedWeights(speedWeights.map(item => item.id === id ? {...item, bobot: parseFloat(val) || 0} : item));
  };

  const handleLeadChange = (id, val) => {
    setLeadWeights(leadWeights.map(item => item.id === id ? {...item, bobot: parseFloat(val) || 0} : item));
  };

  // Fungsi Perbaikan: Mengirim data array komponen ke database lengkap dengan Token Otorisasi JWT
  const handleSave = async (kategori, dataBobot) => {
    const token = localStorage.getItem('jwtToken');

    // Mengubah struktur array objek menjadi satu objek key-value (c1 - c10)
    const payload = {};
    dataBobot.forEach(item => {
      payload[item.id.toLowerCase()] = item.bobot;
    });

    try {
      const response = await fetch(`http://localhost:5000/api/bobot/${kategori}`, {
        method: 'POST',
        headers: { 
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${token}`
        },
        body: JSON.stringify(payload)
      });

      const textData = await response.text();
      let result = {};
      try {
        result = JSON.parse(textData);
      } catch (e) {
        alert(`Server Error (${response.status}): Gagal memproses data internal.`);
        return;
      }

      if (response.ok) {
        alert(result.message || "Bobot kriteria berhasil disimpan!");
      } else {
        alert("Gagal menyimpan: " + (result.pesan || result.error || "Akses ditolak"));
      }
    } catch (error) {
      console.error("Error kirim bobot:", error);
      alert("Gagal terhubung ke server backend.");
    }
  };

  const WeightTable = ({ title, icon, color, data, onEdit, typeCode }) => {
    const total = data.reduce((acc, curr) => acc + curr.bobot, 0).toFixed(2);
    
    return (
      <section className="flex-1 bg-white rounded-[32px] shadow-xl border border-slate-200 overflow-hidden flex flex-col">
        <header className={`p-6 bg-gradient-to-r ${color} text-white flex justify-between items-center shrink-0`}>
          <div className="flex items-center gap-3">
            <div className="bg-white/20 p-2 rounded-xl border border-white/20">{icon}</div>
            <div>
              <h3 className="font-bold text-base leading-none">{title}</h3>
              <p className="text-[9px] opacity-70 uppercase mt-1 font-black tracking-widest text-white/90">Kriteria Bobot (W)</p>
            </div>
          </div>
          <button 
            onClick={() => handleSave(typeCode, data)} 
            className="bg-white text-slate-800 p-2 rounded-xl hover:scale-110 transition-all shadow-lg active:scale-95"
          >
            <Save size={18} />
          </button>
        </header>

        <div className="p-4 overflow-y-auto">
          <table className="w-full border-separate border-spacing-y-1">
            <thead>
              <tr className="text-slate-400 text-[9px] uppercase font-black tracking-widest">
                <th className="px-4 py-2 text-left">ID</th>
                <th className="px-4 py-2 text-left">Kriteria</th>
                <th className="px-4 py-2 text-center">Bobot</th>
              </tr>
            </thead>
            <tbody>
              {data.map((item) => (
                <tr key={item.id} className="group hover:bg-slate-50 transition-colors">
                  <td className="px-4 py-2 font-bold text-blue-600 text-xs bg-slate-50/50 rounded-l-xl border-y border-l border-slate-100">{item.id}</td>
                  <td className="px-4 py-2 text-[11px] font-bold text-slate-700 bg-slate-50/50 border-y border-slate-100">{item.nama}</td>
                  <td className="px-4 py-2 text-center bg-slate-50/50 border-y border-r border-slate-100 rounded-r-xl">
                    <input 
                      type="number" step="0.01" value={item.bobot}
                      onChange={(e) => onEdit(item.id, e.target.value)}
                      className="w-16 bg-white border border-slate-200 px-2 py-1 rounded-lg text-center font-black text-blue-600 text-[11px] outline-none focus:ring-2 focus:ring-blue-500"
                    />
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>

        <footer className="p-4 bg-slate-50 border-t border-slate-100 flex justify-between items-center mt-auto shrink-0">
          <div className="flex items-center gap-2 text-slate-400">
            <AlertCircle size={14} />
            <span className="text-[9px] font-bold uppercase tracking-wider">Total Bobot W:</span>
          </div>
          <span className={`text-sm font-black ${total === "1.00" ? 'text-emerald-600' : 'text-orange-500'}`}>
            {total}
          </span>
        </footer>
      </section>
    );
  };

  return (
    <div className="flex flex-col lg:flex-row gap-8 items-stretch w-full min-h-[600px]">
      <WeightTable 
        title="Kategori Speed" icon={<Timer size={20}/>} color="from-orange-500 to-red-600" 
        data={speedWeights} onEdit={handleSpeedChange} typeCode="speed"
      />
      <WeightTable 
        title="Kategori Lead" icon={<Mountain size={20}/>} color="from-blue-600 to-indigo-700" 
        data={leadWeights} onEdit={handleLeadChange} typeCode="lead"
      />
    </div>
  );
};

export default CriteriaTable;
