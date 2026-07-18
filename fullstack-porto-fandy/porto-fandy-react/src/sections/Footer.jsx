import React from 'react';

const Footer = () => {
  return (
    <footer className="bg-hijau-fandy text-white pt-20 pb-10">
      <div className="max-w-7xl mx-auto px-6 lg:px-12">
        {/* Call to Action Section */}
        <div className="flex flex-col lg:flex-row items-center justify-between gap-10 border-b border-white/10 pb-16 mb-10">

        {/* Left Content */}
          <div className="max-w-2xl text-center lg:text-left">
            <h2 className="text-3xl sm:text-4xl lg:text-5xl font-bold leading-tight text-white">
              Let's Work <span className="text-kuning-fandy">Together.</span>
            </h2>

            <p className="mt-5 text-base sm:text-lg text-gray-400 leading-8">
              Have a project in mind or looking for a developer to join your team?
              I'm always open to new opportunities, collaborations, and exciting
              projects. Let's build something meaningful together.
            </p>
          </div>

          {/* Button */}
          <div className="flex-shrink-0">
            <a
              href="mailto:fandydahlan3@gmail.com"
              className="inline-flex items-center justify-center rounded-full bg-kuning-fandy px-8 py-4 font-semibold text-hijau-fandy transition-all duration-300 hover:scale-105 hover:shadow-2xl"
            >
              Contact Me
            </a>
          </div>

        </div>

        {/* Bottom Section */}
        <div className="flex flex-col md:flex-row justify-between items-center gap-6">
          <div className="text-xl font-bold">
            FANDY <span className="text-kuning-fandy">BONARO</span> DAHLAN
          </div>
          
          <div className="flex gap-8 text-gray-400 font-medium">
            <a href="https://linkedin.com" target="_blank" className="hover:text-kuning-fandy transition">LinkedIn</a>
            <a href="https://github.com" target="_blank" className="hover:text-kuning-fandy transition">GitHub</a>
            <a href="https://instagram.com" target="_blank" className="hover:text-kuning-fandy transition">Instagram</a>
          </div>

          <p className="text-sm text-gray-500">
            © 2024 Fandy Dahlan. All rights reserved.
          </p>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
