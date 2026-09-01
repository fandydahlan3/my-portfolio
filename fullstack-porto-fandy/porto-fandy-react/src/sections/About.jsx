import React from 'react';

const About = () => {
  // Data statistik untuk sisi kanan
  const stats = [
    { label: 'Projects Completed', value: '10+' },
    { label: 'Technologies', value: '10+' },
    { label: 'Years Learning & Building', value: '2Y+' },
  ];

  return (
    <section id="about" className="bg-hijau-fandy py-20 lg:py-28 relative overflow-hidden">
      <div className="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
        <div className="grid lg:grid-cols-2 gap-16 items-center">
          
          {/* Sisi Kiri: Konten Teks */}
          <div className="space-y-6">
            <div>
              <h2 className="text-kuning-fandy font-bold tracking-widest uppercase text-sm mb-2">
                About Me
              </h2>
              <h1 className="text-4xl lg:text-5xl font-bold text-white leading-tight">
                Who is <span className="text-kuning-fandy">Fandy?</span>
              </h1>
            </div>

            <div className="space-y-4 text-gray-300 text-lg leading-relaxed">
              <p>
                I'm a <span className="text-white font-medium">Information Systems graduate</span> with a strong interest in understanding business needs, analyzing processes, and translating those needs into effective digital solutions.
              </p>
              <p>
                I have skills in <span className="text-white font-medium">Business Analysis, System Analysis, Enterprise Architecture, UI/UX Design, Frontend Development, Backend Development, Full Stack Development, Data Analysis, and Multimedia.</span> I enjoy bridging the gap between <span className="text-white font-medium">business needs and technical solutions,</span> from analyzing problems and designing more efficient processes to translating ideas into user-centered systems.
              </p>
              <p>
                I am passionate about continuous learning and committed to delivering <span className="text-kuning-fandy font-medium">structured, practical, and user-focused solutions</span> that provide real value to users and organizations.
              </p>
            </div>
          </div>

          {/* Sisi Kanan: Statistik (Grid) */}
          <div className="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-1 gap-8">
            {stats.map((item, index) => (
              <div 
                key={index} 
                className="text-center lg:text-left border-l-2 border-kuning-fandy/20 pl-0 lg:pl-6 hover:border-kuning-fandy transition-colors duration-300"
              >
                <h3 className="text-5xl lg:text-6xl font-extrabold text-kuning-fandy">
                  {item.value}
                </h3>
                <p className="text-white mt-2 font-medium opacity-80 uppercase tracking-wider text-sm">
                  {item.label}
                </p>
              </div>
            ))}
          </div>
        </div>
      </div>

      {/* Dekorasi Latar Belakang */}
      <div className="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-96 h-96 bg-kuning-fandy opacity-5 rounded-full blur-[100px]"></div>
      <div className="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-64 h-64 bg-kuning-fandy opacity-5 rounded-full blur-[80px]"></div>
    </section>
  );
};

export default About;
