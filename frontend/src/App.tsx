import { BrowserRouter } from "react-router";
import {Router} from "./Router/Router";
import { Footer } from "./components/Footer/Footer";
import { Header } from "./components/Header/Header";
import './App.scss'

export default function App() {

  return (
    <>
      <BrowserRouter>
      <Header />
      <Router />
      <Footer />
      </BrowserRouter>
    </>
  )
}

