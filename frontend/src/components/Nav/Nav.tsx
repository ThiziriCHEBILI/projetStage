import type { JSX } from "react";
import { NavLink } from "react-router";
import "./Nav.scss";

export function Nav(): JSX.Element {
  return (
    <nav className="nav" aria-label="Menu principal">
      <NavLink to="/" className="nav__link">
        Accueil
      </NavLink>
      <NavLink to="/shows/films" className="nav__link">
        Films
      </NavLink>
      <NavLink to="/shows/series" className="nav__link">
        Séries
      </NavLink>
      <NavLink to="/shows/dessins-animes" className="nav__link">
        Dessins animés
      </NavLink>
      <NavLink to="/ma-liste" className="nav__link">
        Ma Liste
      </NavLink>
    </nav>
  );
}
