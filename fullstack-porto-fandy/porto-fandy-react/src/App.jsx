import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom'; // Tambahkan ini
import Navbar from './components/Navbar';
import Hero from './sections/Hero';
import About from './sections/About';
import Skills from './sections/Skills';
import Portfolio from './sections/Portfolio';
import Footer from './sections/Footer';
import Admin from './sections/Admin'; // Pastikan file Admin.jsx sudah kamu buat di folder sections

function App() {
  return (
    <Router> {/* Bungkus dengan Router */}
      <div className="min-h-screen bg-gray-950 text-white selection:bg-kuning-fandy selection:text-hijau-fandy">
        <Routes>
          {/* RUTE HALAMAN UTAMA */}
          <Route path="/" element={
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
          } />

          {/* RUTE HALAMAN ADMIN */}
          <Route path="/admin" element={<Admin />} />
        </Routes>
      </div>
    </Router>
  );
}

export default App;
