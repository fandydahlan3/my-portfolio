import React, { useState, useEffect } from "react";
import axios from "axios"; 
// Import Swiper React components & styles
import { Swiper, SwiperSlide } from "swiper/react";
import { Autoplay } from "swiper/modules";
import "swiper/css";

const Skills = () => {
  const [skills, setSkills] = useState([]);

  useEffect(() => {
    // Pastikan backend kamu sudah nyala di port 5000
    axios.get('http://localhost:5000/api/skills')
      .then(res => {
        setSkills(res.data);
      })
      .catch(err => console.log("Gagal ambil data skills:", err));
  }, []);

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
          loop={skills.length > 5} // Loop hanya jika data lebih dari jumlah view agar tidak error
          autoplay={{ delay: 2000, disableOnInteraction: false }}
          breakpoints={{
            640: { slidesPerView: 3 },
            1024: { slidesPerView: 5 },
          }}
          modules={[Autoplay]}
          className="py-10"
        >
          {skills.map((skill, index) => (
            <SwiperSlide key={skill.id || index}>
              <div className="flex flex-col items-center group cursor-grab active:cursor-grabbing">
                <div className="w-32 h-32 rounded-full border-2 border-gray-100 flex items-center justify-center bg-[#F8F9FA] group-hover:border-kuning-fandy transition-all duration-300 shadow-sm group-hover:shadow-md overflow-hidden">
                  <img
                    src={skill.image_url}
                    alt={skill.name}
                    className="w-16 h-16 object-contain grayscale group-hover:grayscale-0 transition-all duration-300"
                    // Perbaikan: Placeholder gambar jika link rusak
                    onError={(e) => (e.target.src = "https://placeholder.com")}
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
