import { Routes, Route } from "react-router";
import Category from "../Pages/Category/Category";
import { filmsPage, seriesPage, animesPage } from "../data/data";
import Home from "../Pages/Home/Home";
import Login from "../Pages/Login/Login";
import Register from "../Pages/Register/Register";
import Show from "../Pages/Show/Show";
import MyList from "../Pages/MyList/MyList";
import LegalNotice from "../Pages/LegalNotice/LegalNotice";

export function Router() {
  return (
    <Routes>
      <Route path="/" element={<Home />} />
      <Route path="/login" element={<Login />} />
      <Route path="/register" element={<Register />} />
      <Route path="/ma-liste" element={<MyList />} />
      <Route path="/mentions-legales" element={<LegalNotice />} />

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
      <Route path="/shows/:name/:id" element={<Show />} />
    </Routes>
  );
}
