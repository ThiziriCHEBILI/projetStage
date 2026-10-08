import type { JSX } from "react";
import { Link } from "react-router";
import { showTypes } from "../../data/data";
import "./TypeFilters.scss";

export function TypeFilters(): JSX.Element {
  return (
    <div className="types">
      {showTypes.map((type) => (
        <Link key={type} to={"/type/" + type} className="types__item">
          {type}
        </Link>
      ))}
    </div>
  );
}