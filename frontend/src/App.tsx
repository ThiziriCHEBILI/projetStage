import { BrowserRouter } from "react-router-dom";
import {Router} from "./Router/Router";
import './App.css'

export default function App() {

  return (
    <>
      <BrowserRouter>
      <Router />
      </BrowserRouter>
    </>
  )
}

