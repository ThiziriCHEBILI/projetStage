import type { JSX } from "react";
import { showTypes } from "../../data/data";
import { FilterButtons } from "../FilterButtons/FilterButtons";

interface TypeFiltersProps {
  activeType: string;
  onSelect: (type: string) => void;
}

export function TypeFilters({
  activeType,
  onSelect,
}: TypeFiltersProps): JSX.Element {
  const buttons = [
    { value: "", label: "Tout" },
    ...showTypes.map((type) => ({
      value: type,
      label: type,
    })),
  ];

  return (
    <FilterButtons buttons={buttons} active={activeType} onSelect={onSelect} />
  );
}
