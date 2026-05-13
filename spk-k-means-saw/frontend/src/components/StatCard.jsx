import React from 'react';

const StatCard = ({ label, value, icon, colorClass }) => {
  return (
    <div className="bg-white p-6 rounded-[24px] shadow-sm border border-slate-100 flex items-center gap-5 hover:shadow-md transition-all duration-300 group cursor-default">
      {/* Bagian Ikon dengan efek hover */}
      <div className={`p-4 rounded-2xl ${colorClass} text-white shadow-lg transition-transform group-hover:scale-110 duration-300`}>
        {icon}
      </div>
      
      {/* Bagian Teks */}
      <div>
        <p className="text-[10px] text-slate-400 font-bold uppercase tracking-[0.15em] mb-1 opacity-70">
          {label}
        </p>
        <div className="flex items-baseline gap-1">
          <h4 className="text-2xl font-black text-slate-800 leading-none tracking-tight">
            {value}
          </h4>
        </div>
      </div>
    </div>
  );
};

export default StatCard;
