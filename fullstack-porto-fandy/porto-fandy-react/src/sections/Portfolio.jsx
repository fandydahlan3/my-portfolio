import React, { useState } from "react";

// 1. DATA PROYEK LOKAL (Silakan ganti atau tambah sesuai dengan isi proyek asli Anda)
// Pastikan kategori diisi antara: "Web Development", "Data Science", atau "Mobile & Multimedia"
const staticProjects = [
  {
    id: 1,
    title: "Pendaftaran Santri Baru (PSB)",
    category: "Full Stack",
    description: "A responsive online registration application for prospective santri, designed to simplify the new student admission process.",
    image: "/images/project-psb.png", 
    project_url: "https://github.com/fandydahlan3/my-portfolio/tree/main/psb.smpit-arrisalahcariu.sch.id",
    tech_stack: "PHP, bootstrap, HTML, CSS"
  },
  {
    id: 2,
    title: "KOPRASI ABATASA",
    category: "Full Stack",
    description: "A cooperative management application for ABATASA that enables users to perform transactions and view transaction details.",
    image: "/images/ABATAS.png", 
    project_url: "https://github.com/fandydahlan3/my-portfolio/tree/main/ci-kop-risalah",
    tech_stack: "PHP, bootstrap, CodeIgniter 4, HTML, CSS"
  },
  {
    id: 3,
    title: "Penerapan Metode K-means Dan Metode Simple Additive Weighting (SAW)",
    category: "Data Science",
    description: "Implementation of K-Means and Simple Additive Weighting (SAW) Methods for Recommending Rock Climbing Athletes to Participate in Competitions.",
    image: "/images/SAW_lead.png", 
    project_url: "https://drive.google.com/file/d/1Z0_DGZEVaacOS8vgwnwXQefwwFNU5kpG/view?usp=sharing",
    tech_stack: "K-means, SAW, prototype, diagram activity, use case diagram, dll."
  },
  {
    id: 4,
    title: "Aplikasi SPK Atlet Climbing",
    category: "Full Stack",
    description: "A decision support application designed to identify the most eligible rock climbing athletes for competition participation.",
    image: "/images/SPK.png", 
    project_url: "https://github.com/fandydahlan3/my-portfolio/tree/main/spk-k-means-saw",
    tech_stack: "React, Vite, Node.js, Express.js, Python, Tailwind CSS"
  },
  {
    id: 5,
    title: "Aplikasi Portofolio Fandy",
    category: "UI/UX",
    description: "A personal portfolio website showcasing Fandy's projects, skills, and professional experience.",
    image: "/images/porto_figma.png", 
    project_url: "https://www.figma.com/design/cq2ZMChE2nWHM87wXlEshm/PORTO-FANDY?node-id=0-1&t=ZqvxH2BpHPPhzAAJ-1",
    tech_stack: "Figma"
  },
  {
    id: 6,
    title: "Aplikasi Tinggal Klik",
    category: "Frontend",
    description: "A responsive web-based portfolio application designed to showcase Fandy's profile, projects, skills, and professional experience.",
    image: "/images/Tiggal_klik.png", 
    project_url: "https://github.com/fandydahlan3/my-portfolio/tree/main/tinggalklik-landing-page",
    tech_stack: "Ract, vite"
  },
  {
    id: 7,
    title: "App Mobile POS",
    category: "UI/UX",
    description: "Point Of Sale.",
    image: "/images/Login.png", 
    project_url: "https://www.figma.com/design/oxsZahfyPclkISy8ZFvzfs/kasir-mobile?node-id=0-1&t=h9kMfr5pFX9CqMXR-1",
    tech_stack: "Figma"
  },
  {
    id: 8,
    title: "BA Aplikasi SPK Atlet Climbing",
    category: "Business Analyst",
    description: "Business Analyst",
    image: "/images/Proses Bisnis Baru.jpg", 
    project_url: "https://github.com/fandydahlan3/my-portfolio/tree/main/spk-k-means-saw/Business%20Analyst",
    tech_stack: "Enterprise Architecture"
  },
  {
    id: 9,
    title: "Benner Open Recruitment",
    category: "Multimedia",
    description: "Open Recruitment Binaniaga Mahasiswa Pecinta Alam",
    image: "/images/OP.png", 
    project_url: "https://drive.google.com/file/d/1CfRx8sstwrsUXRHwEMm-PquUaosnVZDZ/view?usp=sharing",
    tech_stack: "Photoshop"
  },
  {
    id: 10,
    title: "Baliho DESA",
    category: "Multimedia",
    description: "Desa Bersih Narkoba",
    image: "/images/BNN 3x2.png", 
    project_url: "https://drive.google.com/file/d/1rIxOyqUlPnXaHS9QaPhlDDEptS6maI_v/view?usp=sharing",
    tech_stack: "Photoshop"
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
  const categories = ["All","Business Analyst","Full Stack","Backend","Frontend","UI/UX","Data Science","Mobile","Multimedia"];

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
        <div className="flex flex-wrap justify-center items-center gap-3 max-w-4xl mx-auto mb-12 px-4">
  {categories.map((cat) => (
    <button
      key={cat}
      onClick={() => {
        setActiveFilter(cat);
        setVisibleCount(8); 
      }}
      className={`px-5 py-2.5 rounded-full text-xs font-bold transition-all duration-300 border flex-shrink-0 whitespace-nowrap tracking-wide shadow-sm ${
        activeFilter === cat
          ? "bg-hijau-fandy text-white border-hijau-fandy shadow-md scale-105"
          : "bg-white text-gray-500 border-gray-200 hover:border-kuning-fandy hover:text-kuning-fandy hover:scale-105"
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
            <div className="flex justify-center mt-14">
              <button
                onClick={() => setVisibleCount(visibleCount + 4)}
                className="group inline-flex items-center gap-2 bg-hijau-fandy text-white px-7 py-3 rounded-full text-sm font-bold shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300"
              >
                Load More
                <span className="text-lg group-hover:translate-y-1 transition-transform duration-300">
                  ↓
                </span>
              </button>
            </div>
          )}

          {/* Jika kategori kosong */}
          {filteredProjects.length === 0 && (
            <div className="flex flex-col items-center justify-center py-16 text-center">
              <div className="w-16 h-16 flex items-center justify-center rounded-full bg-gray-100 mb-4">
                <span className="text-2xl">📁</span>
              </div>

              <h3 className="text-lg font-bold text-hijau-fandy mb-1">
                No Projects Found
              </h3>

              <p className="text-sm text-gray-400 max-w-sm">
                There are currently no projects available in this category.
              </p>
            </div>
          )}
        </>
      </div>
    </section>
  );
};

export default Portfolio;
