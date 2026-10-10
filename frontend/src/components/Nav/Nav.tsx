import type { JSX } from "react";
import { NavLink } from "react-router";
import "./Nav.scss";

export function Nav(): JSX.Element {
  return (
    <nav className="nav" aria-label="Menu principal">
      <NavLink to="/">Accueil</NavLink>
      <NavLink to="/shows/films">Films</NavLink>
      <NavLink to="/shows/series">Séries</NavLink>
      <NavLink to="/shows/dessins-animes">Dessins animés</NavLink>
      <NavLink to="/ma-liste">Ma Liste</NavLink>
    </nav>
  );
}