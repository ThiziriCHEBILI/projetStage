import type { JSX } from "react";
import "./FilterButtons.scss";

interface FilterItem<T> {
  value: T;
  label: string;
}

interface FilterButtonsProps<T> {
  buttons: FilterItem<T>[];
  active: T;
  onSelect: (value: T) => void;
}

export function FilterButtons<T>({
  buttons,
  active,
  onSelect,
}: FilterButtonsProps<T>): JSX.Element {
  return (
    <div className="filters">
      {buttons.map((button) => (
        <button
          key={button.label}
          type="button"
          aria-pressed={button.value === active}
          className={
            button.value === active
              ? "filters__button filters__button--active"
              : "filters__button"
          }
          onClick={() => onSelect(button.value)}
        >
          {button.label}
        </button>
      ))}
    </div>
  );
}
