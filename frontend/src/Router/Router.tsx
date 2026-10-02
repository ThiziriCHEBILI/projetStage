import {Routes, Route } from "react-router";
import Home from '../Pages/Home/Home'

export function Router() {
    return (
    <Routes>
        <Route path="/" element={<Home />} />
        
        </Routes>
    );
}