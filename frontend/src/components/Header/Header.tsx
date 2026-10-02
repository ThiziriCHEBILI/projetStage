import type { JSX } from "react";
import { Link, NavLink } from "react-router";
import logo from "../../assets/logo_NOVA.png";
import "./Header.scss";

export function Header(): JSX.Element {
  return (
    <header className="header">
        <div className="header__navigation">
          <div className="header__logo">
            <Link to="/" className="header__logo-link">
              <img src={logo} alt="Nova" className="header__logoNOVA" />
              <span className="header__name">NOVA</span>
            </Link>
          </div>
          <nav className="header__nav">
            <NavLink to="/">Accueil</NavLink>
            <NavLink to="/shows/films">Films</NavLink>
            <NavLink to="/shows/series">Séries</NavLink>
            <NavLink to="/shows/dessins-animes">Dessins animés</NavLink>
            <NavLink to="/ma-liste">Ma Liste</NavLink>
          </nav>
        </div>
        <div className="header__tools">
          <div className="header__form">
            <form className="header__search">
              <i
                className="fa-solid fa-magnifying-glass"
                aria-hidden="true"
              ></i>
              <input
                type="search"
                placeholder="Rechercher un film, une série..."
              />
            </form>
          </div>

          <Link to="/connexion" className="header__login">
            <i className="fa-solid fa-circle-user" aria-hidden="true"></i>
            Connexion
          </Link>
        </div>
    </header>
  );
}
