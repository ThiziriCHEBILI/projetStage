import { useState } from "react";
import type { JSX, ChangeEvent, SubmitEvent } from "react";
import { Link } from "react-router";
import type { Show } from "../../Types";
import { imageUrl } from "../../utilities/imageUrl";
import "./SearchBar.scss";

interface SearchBarProps {
  suggestions?: Show[];
  onSearch?: (searchText: string) => void;
  onSubmit: (searchText: string) => void;
}

export function SearchBar({
  suggestions = [],
  onSearch,
  onSubmit,
}: SearchBarProps): JSX.Element {
  const [searchText, setSearchText] = useState("");
  const [isOpen, setIsOpen] = useState(false);
  const showSuggestions = isOpen && suggestions.length > 0;

  function handleChange(event: ChangeEvent<HTMLInputElement>): void {
    setSearchText(event.target.value);
    setIsOpen(true);
    onSearch?.(event.target.value);
  }

  function handleSubmit(event: SubmitEvent<HTMLFormElement>): void {
    event.preventDefault();
    setIsOpen(false);
    onSubmit(searchText);
  }

  return (
    <form className="search-bar" role="search" onSubmit={handleSubmit}>
      <i
        className="search-bar__icon fa-solid fa-magnifying-glass"
        aria-hidden="true"
      ></i>
      <input
        className="search-bar__input"
        type="search"
        aria-label="Rechercher sur NOVA"
        placeholder="Rechercher un film, une série..."
        value={searchText}
        onChange={handleChange}
        onFocus={() => setIsOpen(true)}
        onClick={() => setIsOpen(true)}
      />

      {showSuggestions && (
        <ul className="search-bar__list">
          {suggestions.map((show) => (
            <li key={show.id}>
              <Link
                className="search-bar__item"
                to={`/shows/${show.category_show.name}/${show.id}`}
                onClick={() => setIsOpen(false)}
              >
                <img
                  className="search-bar__poster"
                  src={imageUrl(show, show.image_poster)}
                  alt=""
                />
                <span className="search-bar__title">{show.title}</span>
              </Link>
            </li>
          ))}
        </ul>
      )}
    </form>
  );
}
