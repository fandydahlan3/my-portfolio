import React, { useState } from "react";

const Hero = () => {
  // State untuk kontrol buka-tutup menu
  const [isOpen, setIsOpen] = useState(false);

  return (
    <section id="home" className="relative bg-[#F8F9FA] py-20 lg:py-32 overflow-hidden">
      <div className="max-w-7xl mx-auto px-6 lg:px-12">
        <div className="grid lg:grid-cols-2 gap-12 items-center">
          
          {/* Sisi Kiri: Teks */}
          <div className="text-center lg:text-left z-20 relative">
            <h2 className="text-2xl sm:text-3xl lg:text-4xl font-bold text-kuning-fandy">
              Hi, I'm
            </h2>

            <h1 className="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-hijau-fandy leading-tight">
              Fandy <span className="text-kuning-fandy">Bonaro</span> Dahlan.
            </h1>

            <h3 className="mt-2 text-xl sm:text-2xl lg:text-3xl font-bold text-hijau-fandy">
              <span className="text-kuning-fandy">Business Analyst</span> & Software Developer
            </h3>

            <p className="mt-6 text-base sm:text-lg text-gray-600 max-w-xl mx-auto lg:mx-0 leading-relaxed">
              Bridging <span className="text-hijau-fandy font-medium">business needs and technical solutions</span> through Business Analysis, System Analysis, Enterprise Architecture, UI/UX Design, and Software Development.
            </p>
          

            {/* Tombol Action */}
            <div className="mt-10 flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
              <a href="#portfolio" className="bg-hijau-fandy text-white px-8 py-4 rounded-xl font-bold shadow-lg hover:bg-opacity-90 transition-all text-center">
                View Portfolio
              </a>

              {/* Dropdown CV - VERSI KLIK MURNI (ANTI KABUR) */}
              <div className="relative z-30">
                <button 
                  type="button"
                  onClick={() => setIsOpen(!isOpen)} 
                  className="border-2 border-hijau-fandy text-hijau-fandy px-8 py-4 rounded-xl font-bold hover:bg-hijau-fandy hover:text-white transition-all w-full sm:w-auto flex items-center justify-center gap-2"
                >
                  Download CV
                  <svg className={`w-4 h-4 transition-transform duration-300 ${isOpen ? 'rotate-180' : ''}`} fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7" />
                  </svg>
                </button>

                {/* Menu hanya muncul jika diklik (Bukan Hover) */}
                {isOpen && (
                  <div className="absolute top-full left-1/2 -translate-x-1/2 w-64 z-50 mt-2 bg-white border border-gray-100 shadow-2xl rounded-xl overflow-hidden">
                    <div className="flex flex-col">
                      <a 
                        href="/CV_WebDev_Fandy.pdf" 
                        download 
                        onClick={() => setIsOpen(false)}
                        className="px-6 py-4 text-sm font-bold text-hijau-fandy hover:bg-kuning-fandy transition-colors border-b border-gray-50"
                      >
                        📄 Web Developer Version
                      </a>
                      <a 
                        href="/CV_DataScience_Fandy.pdf" 
                        download 
                        onClick={() => setIsOpen(false)}
                        className="px-6 py-4 text-sm font-bold text-hijau-fandy hover:bg-kuning-fandy transition-colors"
                      >
                        📊 Data Scientist Version
                      </a>
                    </div>
                  </div>
                )}
              </div>
            </div>
          </div>

          {/* Sisi Kanan: Foto Profil */}
          <div className="flex justify-center relative z-10">
            <div className="absolute inset-0 bg-kuning-fandy opacity-10 blur-3xl rounded-full scale-110"></div>
            <div className="relative w-64 h-64 lg:w-[450px] lg:h-[450px] rounded-full overflow-hidden border-[12px] border-white shadow-2xl">
              <img 
                src="/fandy1.png" 
                alt="Fandy Dahlan" 
                className="w-full h-full object-cover" 
                onError={(e) => e.target.src = "https://placeholder.com"} 
              />
            </div>
          </div>

        </div>
      </div>
    </section>
  );
};

export default Hero;
