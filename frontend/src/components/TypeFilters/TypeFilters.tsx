import type { JSX } from "react";
import { showTypes } from "../../data/data";
import "./TypeFilters.scss";

interface TypeFiltersProps {
  activeType: string;
  onSelect: (type: string) => void;
}

export function TypeFilters({
  activeType,
  onSelect,
}: TypeFiltersProps): JSX.Element {
  return (
    <div className="types">
      <button
        type="button"
        className={`types__button ${activeType === "" ? "types__button--active" : ""}`}
        onClick={() => onSelect("")}
      >
        Tout
      </button>

      {showTypes.map((type) => (
        <button
          key={type}
          type="button"
          className={`types__button ${type === activeType ? "types__button--active" : ""}`}
          onClick={() => onSelect(type)}
        >
          {type}
        </button>
      ))}
    </div>
  );
}