import React from "react"; 
// Import Swiper React components & styles
import { Swiper, SwiperSlide } from "swiper/react";
import { Autoplay } from "swiper/modules";
import "swiper/css";

// 1. DATA YANG DIUBAH: Menggunakan data lokal (silakan sesuaikan namanya)
const staticSkills = [
  { id: 1, name: "React.js", image_url: "/images/react.png" },
  { id: 2, name: "Node.js", image_url: "/images/node.png" },
  { id: 3, name: "Tailwind CSS", image_url: "/images/tailwind.png" },
  { id: 4, name: "Python", image_url: "/images/python.png" },
  { id: 5, name: "MySQL", image_url: "/images/mysql.png" },
];

const Skills = () => {
  return (
    <section id="skills" className="py-24 bg-white overflow-hidden">
      <div className="max-w-7xl mx-auto px-6">
        <div className="text-center mb-16">
          <h2 className="text-hijau-fandy font-bold uppercase tracking-widest text-sm mb-4">Favorite Tools</h2>
          <h1 className="text-4xl lg:text-5xl font-extrabold text-hijau-fandy">
            My Creative <span className="text-kuning-fandy">Tech Stack.</span>
          </h1>
        </div>

        <Swiper
          spaceBetween={30}
          slidesPerView={2}
          loop={staticSkills.length > 3} 
          autoplay={{ delay: 2000, disableOnInteraction: false }}
          breakpoints={{
            640: { slidesPerView: 3 },
            1024: { slidesPerView: 5 },
          }}
          modules={[Autoplay]}
          className="py-10"
        >
          {/* 2. DATA YANG DIUBAH: Looping dari data staticSkills di atas */}
          {staticSkills.map((skill) => (
            <SwiperSlide key={skill.id}>
              <div className="flex flex-col items-center group cursor-grab active:cursor-grabbing">
                <div className="w-32 h-32 rounded-full border-2 border-gray-100 flex items-center justify-center bg-[#F8F9FA] group-hover:border-kuning-fandy transition-all duration-300 shadow-sm group-hover:shadow-md overflow-hidden">
                  <img
                    src={skill.image_url}
                    alt={skill.name}
                    className="w-16 h-16 object-contain grayscale group-hover:grayscale-0 transition-all duration-300"
                    onError={(e) => (e.target.src = "https://placeholders.dev")}
                  />
                </div>
                <p className="mt-4 font-bold text-gray-400 group-hover:text-hijau-fandy transition-colors">
                  {skill.name}
                </p>
              </div>
            </SwiperSlide>
          ))}
        </Swiper>
      </div>
    </section>
  );
};

export default Skills;
