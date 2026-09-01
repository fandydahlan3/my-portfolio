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
  const [dots, setDots] = useState('');

  useEffect(() => {
    // Timer untuk loading screen
    const timer = setTimeout(() => {
      setLoading(false);
    }, 2000);

    // Animasi titik-titik
    const dotsTimer = setInterval(() => {
      setDots((prev) => {
        if (prev === '...') return '';
        return prev + '.';
      });
    }, 300);

    return () => {
      clearTimeout(timer);
      clearInterval(dotsTimer);
    };
  }, []);

  // =========================
  // LOADING SCREEN
  // =========================
  if (loading) {
    return (
      <div className="fixed inset-0 bg-[#F8F9FA] flex flex-col items-center justify-center z-50">

        {/* Logo */}
        <img
          src="/F.png"
          alt="Fandy Logo"
          className="w-20 h-20 object-contain animate-flip"
        />

        {/* Loading Text */}
        <div className="mt-4 flex items-center text-xs tracking-[0.3em] text-gray-400 uppercase">
          <span>Loading Portfolio</span>
          <span>{dots}</span>
        </div>

        {/* Loading Bar */}
        <div className="mt-5 w-40 h-1 bg-gray-200 rounded-full overflow-hidden">
          <div className="h-full bg-hijau-fandy rounded-full animate-progress"></div>
        </div>

      </div>
    );
  }

  // =========================
  // MAIN WEBSITE
  // =========================
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