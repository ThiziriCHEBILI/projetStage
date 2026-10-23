import type { JSX } from "react";
import { Link } from "react-router";
import type { Show } from "../../Types/ApiType";
import { imageUrl } from "../../utilities/imageUrl";
import "./TopCard.scss";

interface TopCardProps {
  show: Show;
  position: number;
}

export function TopCard({ show, position }: TopCardProps): JSX.Element {
  return (
    <Link
      to={`/shows/${show.category_show.name}/${show.id}`}
      className="top__link"
    >
      <article className="top">
        <span className="top__position" aria-hidden="true">
          {position}
        </span>

        <img
          src={imageUrl(show, show.image_poster)}
          alt={"Numéro " + position + " : " + show.title}
          className="top__poster"
        />
      </article>
    </Link>
  );
}
