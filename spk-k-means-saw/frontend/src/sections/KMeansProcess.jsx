import React, { useState } from 'react';
import { Layers, Play, CheckCircle, AlertCircle, RefreshCw } from 'lucide-react';

const KMeansProcess = () => {
  const [loading, setLoading] = useState(false);
  const [status, setStatus] = useState(null); 
  const [pesan, setPesan] = useState('');
  const [hasilKlaster, setHasilKlaster] = useState([]);

  const jalankanKMeans = async () => {
    setLoading(true);
    setStatus(null);
    setPesan('');
    
    // Ambil token fisik dari penyimpanan lokal browser
    const tokenJWT = localStorage.getItem('jwtToken');

    try {
      // PERBAIKAN: Menyertakan Authorization header Bearer Token agar tidak terkena Error 401
      const response = await fetch(`http://localhost:5000/api/proses-spk?_ts=${Date.now()}`, {
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${tokenJWT}`
        }
      });
      
      const data = await response.json();

      if (data && !data.error) {
        setStatus('success');
        setPesan(`Sistem berhasil memproses clustering K-Means secara real-time untuk ${data.length} atlet!`);
        setHasilKlaster(data);
      } else {
        setStatus('error');
        setPesan(data.error || "Gagal mengeksekusi algoritma clustering K-Means.");
      }
    } catch (error) {
      console.error("Error K-Means:", error);
      setStatus('error');
      setPesan("Gagal terhubung ke server backend. Pastikan server Node.js aktif.");
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="space-y-6 max-w-4xl mx-auto">
      <div className="bg-white rounded-3xl p-6 shadow-xl border border-slate-200">
        <div className="flex items-center gap-4 mb-4">
          <div className="bg-blue-600 p-3 rounded-2xl text-white"><Layers size={24} /></div>
          <div>
            <h3 className="font-black text-lg tracking-tight text-slate-800">Komputasi Clustering K-Means</h3>
            <p className="text-xs text-slate-400 font-medium">Segmentasi otomatis kelompok spesialisasi atlet (Speed vs Lead Specialist)</p>
          </div>
        </div>

        <p className="text-slate-600 text-xs leading-relaxed mb-6 bg-slate-50 p-4 rounded-xl border border-slate-100">
          Fitur ini akan mengeksekusi skrip cerdas berbasis Python untuk menghitung matriks kedekatan jarak <strong>Euclidean Distance</strong>. 
          Atlet akan dikelompokkan secara objektif ke dalam 2 kelompok klaster berdasarkan kemiripan 10 atribut parameter performa kompetensi.
        </p>

        {status && (
          <div className={`p-4 rounded-2xl flex items-start gap-3 text-xs font-bold mb-6 border ${
            status === 'success' ? 'bg-emerald-50 border-emerald-200 text-emerald-700' : 'bg-red-50 border-red-200 text-red-700'
          }`}>
            <span>{pesan}</span>
          </div>
        )}

        <button
          onClick={jalankanKMeans}
          disabled={loading}
          className="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 disabled:bg-slate-300 text-white text-xs font-black px-6 py-3.5 rounded-xl transition-all flex items-center justify-center gap-2"
        >
          {loading ? <RefreshCw size={16} className="animate-spin" /> : <Play size={16} fill="white" />}
          <span>{loading ? "SEDANG MENGHITUNG JARAK CENTROID..." : "PROSES CLUSTERING SEKARANG"}</span>
        </button>
      </div>

      {status === 'success' && hasilKlaster.length > 0 && (
        <div className="bg-white rounded-3xl p-6 shadow-xl border border-slate-200">
          <h4 className="text-xs font-black text-slate-400 uppercase tracking-widest mb-4 border-b pb-2">Hasil Pembagian Klaster Terkini</h4>
          <div className="overflow-x-auto">
            <table className="w-full border-separate border-spacing-y-2">
              <thead>
                <tr className="text-slate-400 text-[10px] uppercase font-black tracking-tight">
                  <th className="px-4 py-2 text-left">Nama Atlet</th>
                  <th className="px-4 py-2 text-left">Hasil Segmentasi Cluster</th>
                  <th className="px-4 py-2 text-center">Nilai Skor Akhir</th>
                </tr>
              </thead>
              <tbody>
                {hasilKlaster.map((atlet) => (
                  <tr key={atlet.id} className="hover:bg-slate-50 transition-colors text-xs">
                    <td className="px-4 py-3 bg-slate-50/50 border-y border-l border-slate-100 rounded-l-xl font-bold text-slate-700">{atlet.nama_atlet}</td>
                    <td className="px-4 py-3 bg-slate-50/50 border-y border-slate-100 font-bold">
                      <span className={`px-2.5 py-1 rounded-lg text-[10px] font-black ${
                        atlet.cluster === 0 ? 'bg-orange-50 text-orange-600 border border-orange-100' : 'bg-indigo-50 text-indigo-600 border border-indigo-100'
                      }`}>{atlet.kategori}</span>
                    </td>
                    <td className="px-4 py-3 bg-slate-50/50 border-y border-r border-slate-100 text-center font-black text-blue-600 rounded-r-xl">{atlet.skor_saw}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
      )}
    </div>
  );
};

export default KMeansProcess;
