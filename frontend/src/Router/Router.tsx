import { Routes, Route } from "react-router";
import Category from "../Pages/Category/Category";
import { filmsPage, seriesPage, animesPage } from "../data/data";
import Home from "../Pages/Home/Home";

export function Router() {
  return (
    <Routes>
      <Route path="/" element={<Home />} />

      <Route path="/shows/films" element={<Category page={filmsPage} />} />
      <Route path="/shows/series" element={<Category page={seriesPage} />} />
      <Route
        path="/shows/dessins-animes"
        element={<Category page={animesPage} />}
      />
    </Routes>
  );
}
