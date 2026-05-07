import React from 'react';

const Footer = () => {
  return (
    <footer className="bg-hijau-fandy text-white pt-20 pb-10">
      <div className="max-w-7xl mx-auto px-6 lg:px-12">
        {/* Call to Action Section */}
        <div className="flex flex-col md:flex-row justify-between items-center border-b border-white/10 pb-16 mb-10">
          <div className="text-center md:text-left mb-8 md:mb-0">
            <h1 className="text-4xl lg:text-6xl font-bold mb-4">
              Let's work <span className="text-kuning-fandy">together.</span>
            </h1>
            <p className="text-gray-400 text-lg">
              Have a project in mind? Let's make it happen.
            </p>
          </div>
          <a 
            href="mailto:fandydahlan3@gmail.com" 
            className="bg-kuning-fandy text-hijau-fandy px-10 py-4 rounded-full font-bold text-lg hover:scale-105 transition-transform shadow-xl"
          >
            Contact Me
          </a>
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
