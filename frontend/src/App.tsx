import { BrowserRouter } from "react-router";
import {Router} from "./Router/Router";
import { Footer } from "./components/Footer/Footer";
import './App.scss'

export default function App() {

  return (
    <>
      <BrowserRouter>
      <Router />
      <Footer />
      </BrowserRouter>
    </>
  )
}

