const Sidebar = ({ activeTab, setActiveTab }) => {
  return (
    <aside className="w-72 bg-[#0F172A] text-white flex flex-col h-screen sticky top-0 shrink-0">
      <div className="p-8 border-b border-white/5 font-bold text-xl tracking-widest text-blue-400 uppercase italic">
        SPK-Panjat <span className="text-white font-black">Tebing</span>
      </div>

      <nav className="flex-1 px-4 py-6 space-y-2">
        <NavItem 
          label="Dashboard" 
          active={activeTab === 'dashboard'} 
          onClick={() => setActiveTab('dashboard')} 
        />
        <NavItem 
          label="Data Atlet" 
          active={activeTab === 'atlet'} 
          onClick={() => setActiveTab('atlet')} 
        />
      </nav>
    </aside>
  );
};

const NavItem = ({ label, active, onClick }) => (
  <div 
    onClick={onClick}
    className={`px-4 py-3.5 rounded-2xl cursor-pointer transition-all duration-300 font-medium ${
      active ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white'
    }`}
  >
    {label}
  </div>
);
