import type { JSX } from "react";
import "./SeasonButtons.scss";

interface SeasonButtonsProps {
  seasons: number[];
  season: number;
  onSelect: (number: number) => void;
}

export function SeasonButtons({
  seasons,
  season,
  onSelect,
}: SeasonButtonsProps): JSX.Element {
  return (
    <div className="seasons">
      {seasons.map((number) => (
        <button
          key={number}
          type="button"
          aria-pressed={number === season}
          className={
            number === season
              ? "seasons__button seasons__button--active"
              : "seasons__button"
          }
          onClick={() => onSelect(number)}
        >
          Saison {number}
        </button>
      ))}
    </div>
  );
}
