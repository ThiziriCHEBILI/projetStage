import type { JSX } from "react";
import type { Show, Info } from "../../Types";
import { formatSaisons, nombreDeSaisons } from "../../utilities/convert";
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
  const video = show.videos[0];

  let texteInfo = show.type_show;
  if (info === "saison") {
    texteInfo = formatSaisons(nombreDeSaisons(show.videos));
  }

  return (
    <article className="card">
      <img src={show.image_show} alt="" className="card__image" />

      {withQuality && (
        <span className="card__quality">{video.videoQuality}</span>
      )}

      <h3 className="card__title">{show.title}</h3>

      {info && (
        <p className="card__info">
          {new Date(show.release_date).getFullYear()} · {texteInfo}
        </p>
      )}
    </article>
  );
}
