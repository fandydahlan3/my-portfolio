import React, { useEffect, useState } from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';

import Navbar from './components/Navbar';
import Hero from './sections/Hero';
import About from './sections/About';
import Skills from './sections/Skills';
import Portfolio from './sections/Portfolio';
import Footer from './sections/Footer';
import Admin from './sections/Admin';

function App() {
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const timer = setTimeout(() => {
      setLoading(false);
    }, 1200);

    return () => clearTimeout(timer);
  }, []);

  // Loading Screen
  if (loading) {
    return (
      <div className="fixed inset-0 bg-[#F8F9FA] flex flex-col items-center justify-center z-50">
        
        {/* Logo */}
        <h1 className="text-5xl font-extrabold text-hijau-fandy">
          F<span className="text-kuning-fandy">.</span>
        </h1>

        {/* Text */}
        <p className="mt-3 text-xs tracking-[0.3em] text-gray-400 uppercase">
          Loading Portfolio...
        </p>

        {/* Loading Bar */}
        <div className="mt-5 w-32 h-1 bg-gray-200 rounded-full overflow-hidden">
          <div className="w-1/2 h-full bg-hijau-fandy rounded-full animate-pulse"></div>
        </div>

      </div>
    );
  }

  return (
    <Router>
      <div className="min-h-screen bg-gray-950 text-white selection:bg-kuning-fandy selection:text-hijau-fandy">
        
        <Routes>

          {/* =========================
              HALAMAN UTAMA
          ========================== */}
          <Route
            path="/"
            element={
              <>
                <Navbar />

                <main>
                  <Hero />
                  <About />
                  <Skills />
                  <Portfolio />
                </main>

                <Footer />
              </>
            }
          />

          {/* =========================
              HALAMAN ADMIN
          ========================== */}
          <Route
            path="/admin"
            element={<Admin />}
          />

        </Routes>

      </div>
    </Router>
  );
}

export default App;