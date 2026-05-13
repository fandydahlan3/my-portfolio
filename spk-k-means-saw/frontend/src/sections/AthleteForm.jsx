import React, { useState } from 'react';
import { Users, PlusCircle, RefreshCw } from 'lucide-react';

const AthleteForm = ({ authToken, onAthleteAdded }) => {
  const [loading, setLoading] = useState(false);
  const [formData, setFormData] = useState({
    nama_atlet: '',
    bulan: new Date().getMonth() + 1,
    tahun: new Date().getFullYear(),
    c1: '', c2: '', c3: '', c4: '', c5: '',
    c6: '', c7: '', c8: '', c9: '', c10: ''
  });

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    try {
      const response = await fetch('http://localhost:5000/api/atlet', {
        method: 'POST',
        headers: { 
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${authToken}` // PERBAIKAN: Menyertakan token JWT agar diijinkan masuk oleh backend
        },
        body: JSON.stringify(formData),
      });
      const result = await response.json();

      if (result.success) {
        alert(result.message);
        setFormData({
          nama_atlet: '',
          bulan: new Date().getMonth() + 1,
          tahun: new Date().getFullYear(),
          c1: '', c2: '', c3: '', c4: '', c5: '',
          c6: '', c7: '', c8: '', c9: '', c10: ''
        });
        if (onAthleteAdded) onAthleteAdded();
      } else {
        alert(result.error || result.pesan || "Gagal menyimpan data.");
      }
    } catch (error) {
      console.error("Gagal mengirim data:", error);
      alert("Terjadi kesalahan jaringan.");
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="bg-white rounded-3xl p-6 shadow-xl border border-slate-200 max-w-3xl mx-auto">
      <div className="flex items-center gap-4 mb-6">
        <div className="bg-blue-600 p-3 rounded-2xl text-white">
          <Users size={24} />
        </div>
        <div>
          <h3 className="font-black text-lg tracking-tight text-slate-800">Formulir Input Performa Atlet</h3>
          <p className="text-xs text-slate-400 font-medium">Tambah data rekam kompetensi atlet baru berdasarkan kriteria</p>
        </div>
      </div>

      <form onSubmit={handleSubmit} className="space-y-6">
        <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <div className="sm:col-span-1 flex flex-col gap-1.5">
            <label className="text-xs font-bold text-slate-500 uppercase">Nama Lengkap Atlet:</label>
            <input
              type="text"
              value={formData.nama_atlet}
              onChange={(e) => setFormData({ ...formData, nama_atlet: e.target.value })}
              className="bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm font-bold focus:border-blue-500 outline-none transition-colors"
              placeholder="Masukkan nama atlet"
              required
            />
          </div>

          <div className="flex flex-col gap-1.5">
            <label className="text-xs font-bold text-slate-500 uppercase">Periode Bulan:</label>
            <select
              value={formData.bulan}
              onChange={(e) => setFormData({ ...formData, bulan: Number(e.target.value) })}
              className="bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm font-bold focus:border-blue-500 outline-none transition-colors"
            >
              <option value="1">Januari</option><option value="2">Februari</option><option value="3">Maret</option>
              <option value="4">April</option><option value="5">Mei</option><option value="6">Juni</option>
              <option value="7">Juli</option><option value="8">Agustus</option><option value="9">September</option>
              <option value="10">Oktober</option><option value="11">November</option><option value="12">Desember</option>
            </select>
          </div>

          <div className="flex flex-col gap-1.5">
            <label className="text-xs font-bold text-slate-500 uppercase">Tahun Kompetensi:</label>
            <input
              type="number"
              value={formData.tahun}
              onChange={(e) => setFormData({ ...formData, tahun: Number(e.target.value) || new Date().getFullYear() })}
              placeholder="Contoh: 2031"
              className="bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm font-bold focus:border-blue-500 outline-none transition-colors w-full"
              required
            />
          </div>
        </div>

        <div className="border-t border-slate-100 pt-4">
          <h4 className="text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Nilai Parameter Atribut (C1 - C10)</h4>
          <div className="grid grid-cols-2 sm:grid-cols-5 gap-4">
            {[...Array(10)].map((_, i) => {
              const keyCol = `c${i + 1}`;
              return (
                <div key={keyCol} className="flex flex-col gap-1.5">
                  <label className="text-[10px] font-black text-slate-400 uppercase">C{i + 1}:</label>
                  <input
                    type="number"
                    step="any"
                    min="0"
                    value={formData[keyCol]}
                    onChange={(e) => setFormData({ ...formData, [keyCol]: e.target.value })}
                    className="bg-slate-50 border border-slate-200 rounded-xl p-2.5 text-xs font-black text-center focus:border-blue-500 outline-none transition-colors"
                    placeholder="0"
                    required
                  />
                </div>
              );
            })}
          </div>
        </div>

        <div className="flex justify-end border-t border-slate-100 pt-4">
          <button
            type="submit"
            disabled={loading}
            className="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 disabled:bg-slate-300 text-white text-xs font-black px-6 py-3.5 rounded-xl transition-all flex items-center justify-center gap-2"
          >
            {loading ? (
              <>
                <RefreshCw size={14} className="animate-spin" />
                <span>MENYIMPAN DATA...</span>
              </>
            ) : (
              <>
                <PlusCircle size={14} />
                <span>TAMBAH ATLET BARU</span>
              </>
            )}
          </button>
        </div>
      </form>
    </div>
  );
};

export default AthleteForm;
