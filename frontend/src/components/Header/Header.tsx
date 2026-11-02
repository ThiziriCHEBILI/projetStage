import { type JSX, startTransition, useState } from "react";
import { Link, useNavigate } from "react-router";
import { SearchBar } from "../SearchBar/SearchBar";
import { Nav } from "../Nav/Nav";
import logo from "../../assets/logo_NOVA.png";
import { useAuth } from "../../context/useAuth";
import { useSearchSuggestions } from "../../utilities/useSearchSuggestions";
import "./Header.scss";

export function Header(): JSX.Element {
  const { user, loadingUser, logout } = useAuth();
  const navigate = useNavigate();
  const [searchText, setSearchText] = useState("");
  const suggestions = useSearchSuggestions(searchText);

  function handleSearch(text: string): void {
    setSearchText(text);
  }

  function handleSubmit(): void {
    const firstShow = suggestions[0];

    if (!firstShow) {
      return;
    }

    navigate(`/shows/${firstShow.category_show.name}/${firstShow.id}`);
  }

  function handleLogout(): void {
    // startTransition regroupe le changement de page et la déconnexion.
    // Sans lui, Ma Liste croit que personne n'est connecté avant le changement de page,
    // et elle redirige vers la connexion au lieu de l'accueil.
    startTransition(() => {
      navigate("/");
      logout();
    });
  }

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
        <SearchBar
          suggestions={suggestions}
          onSearch={handleSearch}
          onSubmit={handleSubmit}
        />

        {!loadingUser &&
          (user ? (
            <div className="header__account">
              <i
                className="header__account-icon fa-solid fa-circle-user"
                aria-hidden="true"
              ></i>
              <div className="header__account-text">
                <span className="header__user">
                  {user.name} {user.surname}
                </span>
                <button
                  type="button"
                  className="header__login"
                  onClick={handleLogout}
                >
                  Déconnexion
                </button>
              </div>
            </div>
          ) : (
            <Link to="/login" className="header__login">
              <i className="fa-solid fa-circle-user" aria-hidden="true"></i>
              Connexion
            </Link>
          ))}
      </div>
    </header>
  );
}
