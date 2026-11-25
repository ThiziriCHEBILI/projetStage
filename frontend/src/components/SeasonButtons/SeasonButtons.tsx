import type { JSX } from "react";
import { FilterButtons } from "../FilterButtons/FilterButtons";

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
  const buttons = seasons.map((number) => ({
    value: number,
    label: `Saison ${number}`,
  }));

  return (
    <FilterButtons buttons={buttons} active={season} onSelect={onSelect} />
  );
}
