import React, { useEffect, useState } from "react";
import axios from "axios";

const Portfolio = () => {
  const [projects, setProjects] = useState([]);
  const [loading, setLoading] = useState(true);
  
  // --- STATE BARU UNTUK FILTER & LIMIT ---
  const [activeFilter, setActiveFilter] = useState("All");
  const [visibleCount, setVisibleCount] = useState(8); // Default tampilkan 8 proyek awal

  useEffect(() => {
    const fetchProjects = async () => {
      try {
        const res = await axios.get('http://localhost:5000/api/projects');
        setProjects(res.data);
      } catch (err) {
        console.error("Gagal ambil data:", err);
      } finally {
        setLoading(false);
      }
    };
    fetchProjects();
  }, []);

  // --- LOGIKA FILTERING ---
  const filteredProjects = projects.filter((project) => {
    if (activeFilter === "All") return true;
    // Mencocokkan kategori (case-insensitive agar lebih aman)
    return project.category?.toLowerCase() === activeFilter.toLowerCase();
  });

  // Ambil hanya sebanyak visibleCount
  const displayedProjects = filteredProjects.slice(0, visibleCount);

  // Daftar Kategori untuk Tombol (Pastikan namanya sama dengan yang kamu input di Admin)
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
                setVisibleCount(8); // Reset limit saat ganti kategori
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

        {/* Loading State */}
        {loading ? (
          <p className="text-center text-gray-500 italic">Memuat proyek...</p>
        ) : (
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
        )}
      </div>
    </section>
  );
};

export default Portfolio;
