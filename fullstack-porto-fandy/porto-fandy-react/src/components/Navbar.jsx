import React, { useState } from 'react';

const Navbar = () => {
const [isOpen, setIsOpen] = useState(false);
const menuItems = [
    { name: 'Home', href: '#home' },
    { name: 'About', href: '#about' },
    { name: 'Skills', href: '#skills' },
    { name: 'Portfolio', href: '#portfolio' },
  ];
  return (
    <nav className="bg-hijau-fandy sticky top-0 z-50 shadow-lg">
      <div className="max-w-7xl mx-auto px-6 lg:px-12">
        <div className="flex justify-between items-center h-20">
          
          {/* Logo */}
          <div className="flex-shrink-0">
            <h1 className="text-2xl font-extrabold tracking-tight text-white">
              FANDY  <span className="text-kuning-fandy">BONARO</span> DAHLAN
            </h1>
          </div>

          {/* Navigation - Desktop */}
          <div className="hidden md:block">
            <div className="ml-10 flex items-baseline space-x-8">
              {menuItems.map((item) => (
                <a 
                  key={item.name} 
                  href={item.href} 
                  className="text-white hover:text-kuning-fandy px-3 py-2 text-sm font-semibold transition-all"
                >
                  {item.name}
                </a>
              ))}
              <a 
                href="mailto:fandydahlan3@://gmail.com..." 
                className="bg-kuning-fandy hover:bg-yellow-400 text-hijau-fandy px-6 py-2.5 rounded-lg text-sm font-bold shadow-md transition-all active:scale-95 ml-4 inline-block"
              >
                Hire Me
              </a>
            </div>
          </div>

          {/* Mobile Menu Button - Tambah onClick */}
          <div className="md:hidden flex items-center">
            <button 
              onClick={() => setIsOpen(!isOpen)} 
              className="text-white focus:outline-none"
            >
              <svg className="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                {isOpen ? (
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12" />
                ) : (
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h16M4 18h16" />
                )}
              </svg>
            </button>
          </div>
        </div>
      </div>

      {/* 2. MENU MOBILE */}
      <div className={`${isOpen ? 'block' : 'hidden'} md:hidden bg-hijau-fandy border-t border-white/10`}>
        <div className="px-6 py-4 space-y-2">
          {menuItems.map((item) => (
            <a
              key={item.name}
              href={item.href}
              onClick={() => setIsOpen(false)} 
              className="block text-white hover:text-kuning-fandy py-3 border-b border-white/5 font-semibold"
            >
              {item.name}
            </a>
          ))}
        </div>
      </div>
    </nav>
  );
};

export default Navbar;