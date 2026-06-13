import Navbar from '../../components/navbar/navbar'
import Home from './home'
import Features from './features'
import Footer from '../../components/footer/footer'

const landingPage = () => {
  return (
    <div>
        <Navbar/>
        <div>
          <Home/>
          <Features/>
        </div>
        <Footer/>
    </div>
  )
}

export default landingPage