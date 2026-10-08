import type { JSX } from "react";
import type { Show } from "../../Types";
import "./TopCard.scss";

interface TopCardProps {
  show: Show;
  position: number;
}

export function TopCard({ show, position }: TopCardProps): JSX.Element {
  return (
    <article className="top">
      <span className="top__position" aria-hidden="true">
        {position}
      </span>

      <img
        src={show.image_poster}
        alt={"Numéro " + position + " : " + show.title}
        className="top__poster"
      />
    </article>
  );
}