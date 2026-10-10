import type { JSX } from "react";
import type { Show, Info } from "../../Types";
import { formatSeasons } from "../../utilities/convert";
import "./ShowCard.scss";

interface ShowCardProps {
  show: Show;
  withQuality?: boolean;
  info?: Info;
}

export function ShowCard({
  show,
  withQuality,
  info,
}: ShowCardProps): JSX.Element {
  let infoText = show.type_show;

  if (info === "saison") {
    infoText = formatSeasons(show.seasonCount);
  }

  return (
    <article className="card">
      <img
        src={show.image_show}
        alt=""
        className="card__image"
        loading="lazy"
      />

      {withQuality && <span className="card__quality">{show.bestQuality}</span>}

      <h3 className="card__title">{show.title}</h3>

      {info && (
        <p className="card__info">
          {new Date(show.release_date).getFullYear()} · {infoText}
        </p>
      )}
    </article>
  );
}
