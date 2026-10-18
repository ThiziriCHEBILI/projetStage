import { Routes, Route } from "react-router";
import Category from "../Pages/Category/Category";
import { filmsPage, seriesPage, animesPage } from "../data/data";
import Home from "../Pages/Home/Home";
import Login from "../Pages/Login/Login";

export function Router() {
  return (
    <Routes>
      <Route path="/" element={<Home />} />
      <Route path="/login" element={<Login />} />

      <Route
        path="/shows/films"
        element={<Category key="films" page={filmsPage} />}
      />
      <Route
        path="/shows/series"
        element={<Category key="series" page={seriesPage} />}
      />
      <Route
        path="/shows/dessins-animes"
        element={<Category key="dessins-animes" page={animesPage} />}
      />
    </Routes>
  );
}
