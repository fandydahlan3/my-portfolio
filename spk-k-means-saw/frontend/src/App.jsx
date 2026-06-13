  import React, { useState, useEffect } from 'react';
  import { Users, Database, Layers, Star, Timer, Mountain, LayoutDashboard, BarChart3, LogOut, Award, Menu, X, Filter, Download, Eye, Edit3, Trash2 } from 'lucide-react';
  import AthleteForm from './sections/AthleteForm';
  import CriteriaTable from './sections/CriteriaTable';
  import KMeansProcess from './sections/KMeansProcess';
  import Login from './Login';

  // Import untuk Kebutuhan Export Excel
  import * as XLSX from 'xlsx';

  const App = () => {
    const [activeTab, setActiveTab] = useState('dashboard');
    const [isSidebarOpen, setIsSidebarOpen] = useState(false);
    const [athletes, setAthletes] = useState([]);
    const [loading, setLoading] = useState(true);
    
    // Autentikasi token JWT fisik
    const [token, setToken] = useState(localStorage.getItem('jwtToken') || null);
    const isAuthenticated = !!token;

    const [bulan, setBulan] = useState(5); 
    const [tahun, setTahun] = useState(new Date().getFullYear()); 

    // State untuk Kebutuhan Modal Detail Atlet
    const [selectedAthlete, setSelectedAthlete] = useState(null);
    const [isModalOpen, setIsModalOpen] = useState(false);

    // State untuk Kebutuhan Modal Edit Atlet
    const [isEditModalOpen, setIsEditModalOpen] = useState(false);
    const [editForm, setEditForm] = useState({
      id: '', nama_atlet: '', bulan: '', tahun: '',
      c1: 0, c2: 0, c3: 0, c4: 0, c5: 0, c6: 0, c7: 0, c8: 0, c9: 0, c10: 0
    });

    // Fungsi menyusun Header Otorisasi JWT
    const getAuthHeaders = () => ({
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${token}`
    });

    const fetchRanking = async () => {
      if (!token) return;
      setLoading(true);
      try {
        const response = await fetch(`http://localhost:5000/api/proses-spk?bulan=${bulan}&tahun=${tahun}&_ts=${Date.now()}`, {
          headers: getAuthHeaders()
        });

        if (response.status === 401 || response.status === 403) {
          handleLogout();
          return;
        }

        const data = await response.json();
        const dataArray = Array.isArray(data) ? data : [];

        const formattedData = dataArray.map(item => ({
          id: item.id,
          nama: item.nama_atlet,
          cluster: item.kategori,
          skorSAW: item.skor_saw,
          bulan: item.bulan,
          tahun: item.tahun,
          ranking: item.ranking_nasional
        }));
        setAthletes(formattedData);
      } catch (error) {
        console.error("Gagal mengambil data ranking:", error);
        setAthletes([]);
      } finally {
        setLoading(false);
      }
    };

    useEffect(() => {
      if (token) {
        fetchRanking();
      }
    }, [bulan, tahun, token]);

    const handleLoginSuccess = (dataLogin) => {
      if (dataLogin.token) {
        localStorage.setItem('jwtToken', dataLogin.token);
        setToken(dataLogin.token);
        setActiveTab('dashboard');
      }
    };

    const handleLogout = () => {
      localStorage.removeItem('jwtToken');
      setToken(null);
      setAthletes([]);
    };

    const handleAddAthlete = () => {
      fetchRanking();
      setActiveTab('dashboard');
    };

    const handleShowDetail = async (athleteId) => {
      try {
        const atletAktif = athletes.find(a => a.id === athleteId);
        if (!atletAktif) return;

        const responseDetail = await fetch(`http://localhost:5000/api/proses-spk?bulan=${bulan}&tahun=${tahun}&_ts=${Date.now()}`, {
          headers: getAuthHeaders()
        });
        const dataSpk = await responseDetail.json();
        const dataSpkArray = Array.isArray(dataSpk) ? dataSpk : [];
        const atletMentah = dataSpkArray.find(item => item.id === athleteId);

        if (atletMentah) {
          setSelectedAthlete({
            ...atletMentah,
            nama_atlet: atletAktif.nama,
            kategori: atletAktif.cluster,
            skor_saw: atletAktif.skorSAW
          });
          setIsModalOpen(true);
        }
      } catch (error) {
        console.error(error);
      }
    };

    const handleOpenEdit = async (athleteId) => {
      try {
        const responseDetail = await fetch(`http://localhost:5000/api/proses-spk?bulan=${bulan}&tahun=${tahun}&_ts=${Date.now()}`, {
          headers: getAuthHeaders()
        });
        const dataSpk = await responseDetail.json();
        const dataSpkArray = Array.isArray(dataSpk) ? dataSpk : [];
        const atletMentah = dataSpkArray.find(item => item.id === athleteId);

        if (atletMentah) {
          setEditForm({
            id: atletMentah.id, nama_atlet: atletMentah.nama_atlet, bulan: atletMentah.bulan, tahun: atletMentah.tahun,
            c1: atletMentah.C1 || 0, c2: atletMentah.C2 || 0, c3: atletMentah.C3 || 0, c4: atletMentah.C4 || 0, c5: atletMentah.C5 || 0,
            c6: atletMentah.C6 || 0, c7: atletMentah.C7 || 0, c8: atletMentah.C8 || 0, c9: atletMentah.C9 || 0, c10: atletMentah.C10 || 0
          });
          setIsEditModalOpen(true);
        }
      } catch (error) {
        console.error(error);
      }
    };

    const handleUpdateAthlete = async (e) => {
      e.preventDefault();
      try {
        const response = await fetch(`http://localhost:5000/api/atlet/${editForm.id}`, {
          method: 'PUT',
          headers: getAuthHeaders(),
          body: JSON.stringify(editForm)
        });
        const result = await response.json();
        if (result.success) {
          alert("Data atlet berhasil diperbarui!");
          setIsEditModalOpen(false);
          fetchRanking(); 
        }
      } catch (error) {
        console.error(error);
      }
    };

    const handleDeleteAthlete = async (athleteId, athleteName) => {
      const konfirmasi = window.confirm(`Hapus atlet "${athleteName}"?`);
      if (!konfirmasi) return;

      try {
        const response = await fetch(`http://localhost:5000/api/atlet/${athleteId}`, {
          method: 'DELETE',
          headers: getAuthHeaders()
        });
        const result = await response.json();
        if (result.success) {
          alert("Data atlet terhapus!");
          fetchRanking(); 
        }
      } catch (error) {
        console.error(error);
      }
    };

    const handleExportExcel = () => {
      if (athletes.length === 0) return;
      const dataExcel = athletes.map((a, idx) => ({ 'No': idx + 1, 'Nama Atlet': a.nama, 'Kategori': a.cluster, 'Skor SAW': a.skorSAW, 'Rank': a.ranking, 'Bulan': a.bulan, 'Tahun': a.tahun }));
      const worksheet = XLSX.utils.json_to_sheet(dataExcel);
      const workbook = XLSX.utils.book_new();
      XLSX.utils.book_append_sheet(workbook, worksheet, "Ranking");
      XLSX.writeFile(workbook, `Rekap_SPK_${bulan}_${tahun}.xlsx`);
    };

    const handlePrint = () => {
      window.print();
    };

    if (!isAuthenticated) {
      return <Login onLogin={handleLoginSuccess} />;
    }

    return (
      // PERBAIKAN 1: Mengubah flex-row kaku menjadi flex-col pada layar kecil agar sidebar pindah ke atas/bisa digulir
      <div className="flex flex-col lg:flex-row min-h-screen bg-[#F1F5F9] font-sans text-slate-800">
        {/* --- SIDEBAR --- */}
        {/* PERBAIKAN 2: Sidebar menggunakan h-auto di HP dan h-screen hanya di desktop agar tidak menutupi seluruh layar HP */}
        <aside className="w-full lg:w-72 bg-[#0F172A] text-white flex flex-col h-auto lg:h-screen shrink-0 sticky top-0 shadow-2xl z-20">
          <div className="p-6 lg:p-8 flex items-center justify-between border-b border-white/5">
            <div className="flex items-center gap-3">
              <div className="bg-blue-600 p-2 rounded-lg"><BarChart3 size={24} /></div>
              <h1 className="font-bold text-lg text-white uppercase italic">SPK <span className="text-blue-400 font-black">PANJAT</span></h1>
            </div>
          </div>
          {/* PERBAIKAN 3: Menambahkan susunan menu flex-row melintang di HP agar menu berjejer rapi ke samping */}
          <nav className="flex flex-row lg:flex-col gap-1 p-2 lg:p-4 lg:py-6 overflow-x-auto lg:overflow-x-visible flex-1 space-x-1 lg:space-x-0 lg:space-y-2 select-none shrink-0 scrollbar-none">
            <button onClick={() => setActiveTab('dashboard')} className={`flex items-center gap-3 px-4 py-2.5 lg:py-3 rounded-xl text-xs lg:text-sm font-bold transition-all whitespace-nowrap ${activeTab === 'dashboard' ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-white/5 hover:text-white'}`}><LayoutDashboard size={18}/> Dashboard</button>
            <button onClick={() => setActiveTab('atlet')} className={`flex items-center gap-3 px-4 py-2.5 lg:py-3 rounded-xl text-xs lg:text-sm font-bold transition-all whitespace-nowrap ${activeTab === 'atlet' ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-white/5 hover:text-white'}`}><Users size={18}/> Data Atlet</button>
            <button onClick={() => setActiveTab('kmeans')} className={`flex items-center gap-3 px-4 py-2.5 lg:py-3 rounded-xl text-xs lg:text-sm font-bold transition-all whitespace-nowrap ${activeTab === 'kmeans' ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-white/5 hover:text-white'}`}><Layers size={18}/> Proses K-Means</button>
            <button onClick={() => setActiveTab('kriteria')} className={`flex items-center gap-3 px-4 py-2.5 lg:py-3 rounded-xl text-xs lg:text-sm font-bold transition-all whitespace-nowrap ${activeTab === 'kriteria' ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-white/5 hover:text-white'}`}><Database size={18}/> Kriteria & Bobot</button>
          </nav>
          <div className="p-2 lg:p-4 border-t border-white/5 shrink-0 hidden lg:block">
            <button onClick={handleLogout} className="w-full flex items-center justify-center gap-2 bg-red-600/10 hover:bg-red-600 text-red-500 hover:text-white py-3 rounded-xl text-sm font-bold transition-all"><LogOut size={18}/> Logout</button>
          </div>
        </aside>

        {/* --- MAIN CONTENT --- */}
        {/* PERBAIKAN 4: Mengubah h-screen kaku menjadi h-auto di HP agar halaman bisa di-scroll ke bawah saat dibuka di handphone */}
        <main className="flex-1 flex flex-col min-w-0 h-auto lg:h-screen lg:overflow-hidden">
          <header className="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-4 lg:px-10 shrink-0 z-10 shadow-sm print:hidden">
            <div className="flex items-center gap-3">
              <h2 className="text-lg lg:text-2xl font-black text-slate-800 tracking-tight">
                {activeTab === 'dashboard' ? 'Dashboard' : activeTab === 'atlet' ? 'Data Atlet' : activeTab === 'kmeans' ? 'Clustering' : 'Bobot'}
              </h2>
            </div>

            {activeTab === 'dashboard' && (
              <div className="flex items-center gap-2 lg:gap-3 animate-fade-in">
                <button onClick={handleExportExcel} className="text-[9px] lg:text-[10px] font-black bg-emerald-600 text-white px-3 lg:px-4 py-2 rounded-xl hover:bg-emerald-700 transition-all flex items-center gap-2">
                  <Download size={14} /> EXPORT
                </button>
                <button onClick={handlePrint} className="text-[9px] lg:text-[10px] font-black bg-slate-800 text-white px-3 lg:px-4 py-2 rounded-xl hover:bg-slate-700 transition-all flex items-center gap-2">
                  <Database size={14} /> CETAK
                </button>
              </div>
            )}
          </header>

          {/* PERBAIKAN 5: Menambahkan overflow-x-auto pembungkus aman tingkat kontainer utama */}
          <div className="p-4 lg:p-10 space-y-6 lg:space-y-8 overflow-y-auto lg:flex-1 w-full min-w-0">
            {activeTab === 'dashboard' && (
              <>
                {/* PANEL FILTER PERIODE BULAN & INPUT TAHUN MANUAL */}
                <div className="bg-white p-4 rounded-[20px] shadow-md border border-slate-100 flex flex-wrap items-center gap-3 lg:gap-4 print:hidden">
                  <div className="flex items-center gap-2 text-slate-700 font-bold text-xs uppercase tracking-wider"><Filter size={16} className="text-blue-600" /><span>Filter:</span></div>
                  <select value={bulan} onChange={(e) => setBulan(Number(e.target.value))} className="bg-slate-50 border border-slate-200 text-slate-700 text-xs rounded-xl p-2.5 font-bold outline-none flex-1 sm:flex-none">
                    <option value="1">Januari</option><option value="2">Februari</option><option value="3">Maret</option><option value="4">April</option><option value="5">Mei</option><option value="6">Juni</option><option value="7">Juli</option><option value="8">Agustus</option><option value="9">September</option><option value="10">Oktober</option><option value="11">November</option><option value="12">Desember</option>
                  </select>
                  <input type="number" value={tahun} onChange={(e) => setTahun(Number(e.target.value) || new Date().getFullYear())} className="bg-slate-50 border border-slate-200 text-slate-700 text-xs rounded-xl p-2.5 font-bold outline-none w-24 text-center" />
                  <button onClick={fetchRanking} className="bg-blue-600 hover:bg-blue-700 text-white text-xs font-black px-5 py-2.5 rounded-xl flex-1 sm:flex-none">CARI</button>
                </div>

                {loading ? (
                  <div className="flex justify-center p-20 font-black text-blue-600 animate-pulse italic text-xs lg:text-sm">MEMPROSES K-MEANS & SAW...</div>
                ) : (
                  <>
                    {/* RINGKASAN DATA ATLET */}
                    <div className="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-6">
                      <div className="p-4 lg:p-6 bg-white rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between"><div className="space-y-1"><p className="text-slate-400 text-[10px] lg:text-xs font-medium uppercase">Total</p><h4 className="text-xl lg:text-2xl font-black text-slate-700">{athletes.length}</h4></div><div className="p-2 lg:p-3 rounded-xl bg-blue-600 text-white hidden sm:block"><Users size={20}/></div></div>
                      <div className="p-4 lg:p-6 bg-white rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between"><div className="space-y-1"><p className="text-slate-400 text-[10px] lg:text-xs font-medium uppercase">Speed</p><h4 className="text-xl lg:text-2xl font-black text-slate-700">{athletes.filter(a => a.cluster === 'Speed Specialist').length}</h4></div><div className="p-2 lg:p-3 rounded-xl bg-orange-500 text-white hidden sm:block"><Timer size={20}/></div></div>
                      <div className="p-4 lg:p-6 bg-white rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between"><div className="space-y-1"><p className="text-slate-400 text-[10px] lg:text-xs font-medium uppercase">Lead</p><h4 className="text-xl lg:text-2xl font-black text-slate-700">{athletes.filter(a => a.cluster === 'Lead Specialist').length}</h4></div><div className="p-2 lg:p-3 rounded-xl bg-indigo-600 text-white hidden sm:block"><Mountain size={20}/></div></div>
                      <div className="p-4 lg:p-6 bg-white rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between"><div className="space-y-1"><p className="text-slate-400 text-[10px] lg:text-xs font-medium uppercase">Top</p><h4 className="text-xl lg:text-2xl font-black text-slate-700">{athletes.length > 0 ? Math.max(...athletes.map(a => a.skorSAW || 0)).toFixed(4) : "0"}</h4></div><div className="p-2 lg:p-3 rounded-xl bg-yellow-500 text-white hidden sm:block"><Star size={20}/></div></div>
                    </div>

                    {/* AREA TABEL VISUAL PERANKINGAN SPEED DAN LEAD */}
                    <div id="area-tabel" className="flex flex-col lg:flex-row gap-6 lg:gap-8 w-full min-w-0">
                      {['Speed Specialist', 'Lead Specialist'].map((cat) => {
                        const filteredAthletes = athletes.filter(a => a.cluster === cat).sort((a, b) => b.skorSAW - a.skorSAW);
                        return (
                          <div key={cat} id={cat.includes('Speed') ? 'print-speed' : 'print-lead'} className="flex-1 bg-white rounded-[24px] shadow-xl border border-slate-200 overflow-hidden flex flex-col min-w-0">
                            <div className={`p-4 lg:p-5 flex items-center justify-between bg-gradient-to-br ${cat.includes('Speed') ? 'from-orange-500 to-red-600' : 'from-blue-600 to-indigo-700'} text-white shrink-0`}>
                              <div>
                                <h3 className="font-bold text-sm lg:text-lg">{cat}</h3>
                                <p className="text-[9px] lg:text-[10px] opacity-80 font-medium">Periode: {bulan}/{tahun}</p>
                              </div>
                            </div>
                            {/* PERBAIKAN 6: Ditambahkan overflow-x-auto pembungkus tabel agar tidak memotong layar HP */}
                            <div className="p-2 lg:p-4 flex-1 overflow-x-auto w-full">
                              {filteredAthletes.length === 0 ? (
                                <div className="text-center py-12 text-slate-400 text-xs italic">Tidak ada atlet pada periode ini.</div>
                              ) : (
                                <table className="w-full border-separate border-spacing-y-2 min-w-[340px]">
                                  <thead>
                                    <tr className="text-slate-400 text-[9px] lg:text-[10px] uppercase font-black tracking-tight">
                                      <th className="px-2 py-1 text-left w-10">Rank</th>
                                      <th className="px-2 py-1 text-left">Nama</th>
                                      <th className="px-2 py-1 text-center">Skor</th>
                                      <th className="px-2 py-1 text-right print:hidden">Aksi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    {filteredAthletes.map((item, idx) => (
                                      <tr key={item.id} className="hover:bg-slate-50 transition-colors">
                                        <td className="px-2 py-2.5 bg-slate-50/50 border-y border-l border-slate-100 rounded-l-xl">
                                          <div className={`w-6 h-6 rounded-lg flex items-center justify-center font-black text-[10px] ${idx === 0 ? 'bg-yellow-500 text-white' : 'bg-white text-slate-400 border border-slate-200'}`}>{idx + 1}</div>
                                        </td>
                                        <td className="px-2 py-2.5 bg-slate-50/50 border-y border-slate-100 font-bold text-[11px] text-slate-700 max-w-[100px] truncate">{item.nama}</td>
                                        <td className="px-2 py-2.5 bg-slate-50/50 border-y border-slate-100 text-center font-black text-blue-600 text-xs">{typeof item.skorSAW === 'number' ? item.skorSAW.toFixed(4) : item.skorSAW}</td>
                                        <td className="px-2 py-2.5 bg-slate-50/50 border-y border-r border-slate-100 rounded-r-xl text-right print:hidden">
                                          <div className="flex justify-end gap-0.5">
                                            <button onClick={() => handleShowDetail(item.id)} className="text-[8px] font-bold bg-blue-50 text-blue-600 px-1.5 py-1 rounded-md hover:bg-blue-600 hover:text-white transition-all"><Eye size={10} /></button>
                                            <button onClick={() => handleOpenEdit(item.id)} className="text-[8px] font-bold bg-amber-50 text-amber-600 px-1.5 py-1 rounded-md hover:bg-amber-600 hover:text-white transition-all"><Edit3 size={10} /></button>
                                            <button onClick={() => handleDeleteAthlete(item.id, item.nama)} className="text-[8px] font-bold bg-red-50 text-red-600 px-1.5 py-1 rounded-md hover:bg-red-600 hover:text-white transition-all"><Trash2 size={10} /></button>
                                          </div>
                                        </td>
                                      </tr>
                                    ))}
                                  </tbody>
                                </table>
                              )}
                            </div>
                          </div>
                        );
                      })}
                    </div>
                  </>
                )}
              </>
            )}

            {activeTab === 'atlet' && <AthleteForm authToken={token} onAthleteAdded={handleAddAthlete} />}
            {activeTab === 'kriteria' && <CriteriaTable />}
            
            {/* PERBAIKAN 7: Kontainer isolasi mutlak w-full overflow agar formula teks K-Means melar dengan aman di HP */}
            {activeTab === 'kmeans' && (
              <div className="w-full overflow-x-auto min-w-0">
                <KMeansProcess />
              </div>
            )}
          </div>
        </main>

        {/* --- COMPONENT MODAL DETAIL ATRIBUT POP-UP --- */}
        {isModalOpen && selectedAthlete && (
          <div className="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 backdrop-blur-sm print:hidden">
            <div className="bg-white rounded-3xl w-full max-w-lg shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
              <div className="p-6 bg-slate-900 text-white flex items-center justify-between">
                <div>
                  <h3 className="font-black text-lg tracking-tight">{selectedAthlete.nama_atlet}</h3>
                  <p className="text-xs text-slate-400 uppercase font-bold tracking-wider mt-1">{selectedAthlete.kategori}</p>
                </div>
                <button onClick={() => setIsModalOpen(false)} className="p-2 text-slate-400 hover:bg-white/10 rounded-xl text-white"><X size={20} /></button>
              </div>
              
              <div className="p-6 overflow-y-auto space-y-4 flex-1">
                <div className="bg-blue-50 p-4 rounded-2xl flex justify-between items-center">
                  <span className="text-xs font-bold text-slate-500 uppercase">Skor Hasil Akhir SAW:</span>
                  <span className="text-lg font-black text-blue-600">{selectedAthlete.skor_saw}</span>
                </div>
                
                <h4 className="text-xs font-black text-slate-400 uppercase tracking-widest border-b pb-2">Nilai Atribut Kriteria Mentah</h4>
                <div className="grid grid-cols-2 gap-3">
                  {[...Array(10)].map((_, i) => {
                    const keyCol = `C${i + 1}`; 
                    const nilaiMentah = selectedAthlete[keyCol];
                    return (
                      <div key={keyCol} className="flex justify-between p-3 bg-slate-50 rounded-xl border border-slate-100 text-xs">
                        <span className="font-bold text-slate-400 uppercase">Kriteria C{i + 1}:</span>
                        <span className="font-black text-slate-700">
                          {nilaiMentah !== undefined && nilaiMentah !== null ? nilaiMentah : 0}
                        </span>
                      </div>
                    );
                  })}
                </div>
              </div>
              <div className="p-4 bg-slate-50 border-t flex justify-end">
                <button onClick={() => setIsModalOpen(false)} className="bg-slate-800 text-white text-xs font-black px-5 py-2.5 rounded-xl hover:bg-slate-700 transition-all">TUTUP DETAIL</button>
              </div>
            </div>
          </div>
        )}

        {/* --- COMPONENT MODAL FORM EDIT ATLET POP-UP --- */}
        {isEditModalOpen && (
          <div className="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 backdrop-blur-sm print:hidden">
            <form onSubmit={handleUpdateAthlete} className="bg-white rounded-3xl w-full max-w-2xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
              <div className="p-6 bg-amber-600 text-white flex items-center justify-between">
                <div>
                  <h3 className="font-black text-lg tracking-tight">Edit Data & Kriteria Atlet</h3>
                  <p className="text-xs text-amber-200 mt-1">Ubah rekaman nilai parameter kompetensi atlet</p>
                </div>
                <button type="button" onClick={() => setIsEditModalOpen(false)} className="p-2 text-white/70 hover:bg-white/10 rounded-xl text-white"><X size={20} /></button>
              </div>

              <div className="p-6 overflow-y-auto space-y-6 flex-1 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div className="sm:col-span-2 flex flex-col gap-1.5">
                  <label className="text-xs font-bold text-slate-500 uppercase">Nama Lengkap Atlet:</label>
                  <input 
                    type="text" 
                    value={editForm.nama_atlet} 
                    onChange={(e) => setEditForm({ ...editForm, nama_atlet: e.target.value })}
                    className="bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm font-bold focus:border-amber-500 outline-none"
                    required 
                  />
                </div>

                {[...Array(10)].map((_, i) => {
                  const keyCol = `c${i + 1}`;
                  return (
                    <div key={keyCol} className="flex flex-col gap-1.5">
                      <label className="text-xs font-bold text-slate-500 uppercase">Nilai Kriteria C{i + 1}:</label>
                      <input 
                        type="number" 
                        step="any"
                        value={editForm[keyCol]} 
                        onChange={(e) => setEditForm({ ...editForm, [keyCol]: parseFloat(e.target.value) || 0 })}
                        className="bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm font-black focus:border-amber-500 outline-none"
                        required 
                      />
                    </div>
                  );
                })}
              </div>

              <div className="p-4 bg-slate-50 border-t flex justify-end gap-3">
                <button type="button" onClick={() => setIsEditModalOpen(false)} className="bg-slate-200 text-slate-700 text-xs font-black px-5 py-3 rounded-xl hover:bg-slate-300 transition-all">BATAL</button>
                <button type="submit" className="bg-amber-600 text-white text-xs font-black px-5 py-3 rounded-xl hover:bg-amber-700 shadow-md shadow-amber-600/10 transition-all">SIMPAN PERUBAHAN</button>
              </div>
            </form>
          </div>
        )}
      </div>
    );
  };

  export default App;
