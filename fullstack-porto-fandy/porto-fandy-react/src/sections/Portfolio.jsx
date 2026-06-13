import React, { useState } from "react";

// 1. DATA PROYEK LOKAL (Silakan ganti atau tambah sesuai dengan isi proyek asli Anda)
// Pastikan kategori diisi antara: "Web Development", "Data Science", atau "Mobile & Multimedia"
const staticProjects = [
  {
    id: 1,
    title: "Pendaftaran Santri Baru (PSB)",
    category: "Web Development",
    description: "Aplikasi Pendaftaran santri baru responsif untuk memudahkan calon santri baru untuk mendaftar secara online.",
    image: "/images/project-psb.png", 
    project_url: "https://github.com/fandydahlan3/my-portfolio/tree/main/psb.smpit-arrisalahcariu.sch.id",
    tech_stack: "PHP, bootstrap, HTML, CSS,"
  },
  {
    id: 2,
    title: "Data Analisis Penjualan Retail",
    category: "Data Science",
    description: "Analisis tren penjualan menggunakan Python dan visualisasi data interaktif untuk prediksi stok.",
    image: "/logo/python.png", 
    project_url: "https://github.com",
    tech_stack: "Python, Pandas, Seaborn"
  },
  {
    id: 3,
    title: "Aplikasi Augmented Reality Edukasi",
    category: "Mobile & Multimedia",
    description: "Media pembelajaran interaktif berbasis Android untuk mengenalkan tata surya secara 3D.",
    image: "/logo/figma1.png", 
    project_url: "https://github.com",
    tech_stack: "Unity, C#, Blender"
  },
  // Anda bisa menambah baris data proyek baru di sini sesuka hati...
];

const Portfolio = () => {
  // 2. DIUBAH: Hilangkan loading state dari database dan gunakan data array lokal
  const [projects] = useState(staticProjects);
  const [activeFilter, setActiveFilter] = useState("All");
  const [visibleCount, setVisibleCount] = useState(8); 

  // --- LOGIKA FILTERING (Tetap Berjalan Normal) ---
  const filteredProjects = projects.filter((project) => {
    if (activeFilter === "All") return true;
    return project.category?.toLowerCase() === activeFilter.toLowerCase();
  });

  const displayedProjects = filteredProjects.slice(0, visibleCount);
  const categories = ["All", "Web Development", "Data Science", "Mobile & Multimedia"];

  return (
    <section id="portfolio" className="py-20 bg-[#F8F9FA]">
      <div className="max-w-7xl mx-auto px-6">
        
        {/* Header Section */}
        <div className="text-center mb-10">
          <h2 className="text-hijau-fandy font-bold uppercase tracking-widest text-xs mb-2">
            My Portfolio
          </h2>
          <h1 className="text-3xl lg:text-4xl font-extrabold text-hijau-fandy">
            Latest <span className="text-kuning-fandy">Projects.</span>
          </h1>
        </div>

        {/* --- TOMBOL FILTER --- */}
        <div className="flex flex-wrap justify-center gap-2 mb-12">
          {categories.map((cat) => (
            <button
              key={cat}
              onClick={() => {
                setActiveFilter(cat);
                setVisibleCount(8); 
              }}
              className={`px-5 py-2 rounded-full text-xs font-bold transition-all duration-300 border ${
                activeFilter === cat
                  ? "bg-hijau-fandy text-white border-hijau-fandy shadow-lg"
                  : "bg-white text-gray-500 border-gray-200 hover:border-kuning-fandy hover:text-kuning-fandy"
              }`}
            >
              {cat}
            </button>
          ))}
        </div>

        {/* 3. DIUBAH: Langsung menampilkan data proyek lokal */}
        <>
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {displayedProjects.map((project) => (
              <div 
                key={project.id} 
                className="bg-white rounded-2xl overflow-hidden shadow-md group hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col"
              >
                {/* Image Section */}
                <div className="relative h-48 overflow-hidden bg-gray-200">
                  <img 
                    src={project.image} 
                    alt={project.title} 
                    className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                  />
                  <div className="absolute inset-0 bg-hijau-fandy/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <a 
                      href={project.project_url} 
                      target="_blank" 
                      rel="noopener noreferrer" 
                      className="bg-kuning-fandy text-hijau-fandy px-5 py-2 rounded-full text-xs font-bold shadow-md hover:scale-105 transition-transform"
                    >
                      View Project
                    </a>
                  </div>
                </div>

                {/* Content Section */}
                <div className="p-5 flex flex-col flex-grow text-left">
                  <span className="text-kuning-fandy font-bold text-[10px] uppercase tracking-tighter">
                    {project.category}
                  </span>
                  <h3 className="text-lg font-bold text-hijau-fandy mt-1 mb-2 line-clamp-1">
                    {project.title}
                  </h3>
                  <p className="text-gray-500 text-[11px] leading-relaxed mb-4 line-clamp-2">
                    {project.description}
                  </p>

                  {/* Tech Stack */}
                  <div className="mt-auto pt-3 border-t border-gray-50 text-left">
                    <div className="flex flex-wrap gap-1">
                      {project.tech_stack?.split(',').map((tech, i) => (
                        <span key={i} className="bg-gray-100 text-hijau-fandy text-[9px] px-2 py-0.5 rounded-md font-medium">
                          {tech.trim()}
                        </span>
                      ))}
                    </div>
                  </div>
                </div>
              </div>
            ))}
          </div>

          {/* --- TOMBOL SHOW MORE --- */}
          {filteredProjects.length > visibleCount && (
            <div className="text-center mt-12">
              <button 
                onClick={() => setVisibleCount(visibleCount + 4)}
                className="bg-white text-hijau-fandy border-2 border-hijau-fandy px-8 py-3 rounded-xl font-bold hover:bg-hijau-fandy hover:text-white transition-all duration-300 shadow-md"
              >
                Load More Projects
              </button>
            </div>
          )}

          {/* Jika kategori kosong */}
          {filteredProjects.length === 0 && (
            <p className="text-center text-gray-400 mt-10">Belum ada proyek di kategori ini.</p>
          )}
        </>
      </div>
    </section>
  );
};

export default Portfolio;
