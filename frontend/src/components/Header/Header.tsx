import type { JSX, SubmitEvent } from "react";
import { Link } from "react-router";
import { Nav } from "../Nav/Nav";
import logo from "../../assets/logo_NOVA.png";
import "./Header.scss";

export function Header(): JSX.Element {
  const handleSubmit = (e: SubmitEvent) => {
    e.preventDefault();
  };

  return (
    <header className="header">
      <div className="header__navigation">
        <Link to="/" className="header__logo-link">
          <img src={logo} alt="NOVA" className="header__logoNOVA" />
          <span className="header__name">NOVA</span>
        </Link>

        <Nav />
      </div>

      <div className="header__tools">
        <form className="header__search" onSubmit={handleSubmit}>
          <button type="submit" aria-label="Lancer la recherche">
            <i className="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
          </button>
          <input
            type="search"
            name="query"
            aria-label="Rechercher sur NOVA"
            placeholder="Rechercher un film, une série..."
          />
        </form>

        <Link to="/connexion" className="header__login">
          <i className="fa-solid fa-circle-user" aria-hidden="true"></i>
          Connexion
        </Link>
      </div>
    </header>
  );
}
