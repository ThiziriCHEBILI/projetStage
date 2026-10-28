import type { JSX } from "react";
import { Link } from "react-router";
import type { Show, Info } from "../../Types";
import { formatSeasons } from "../../utilities/convert";
import { API_URL } from "../../utilities/fetchApi";
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
  let infoText: string | null = show.type_show;

  if (info === "saison" && show.season_count !== null) {
    infoText = formatSeasons(show.season_count);
  }
  const imageUrl = show.category_show
    ? `${API_URL}/images/${show.category_show.name}/${show.image_show}`
    : show.image_show;

  return (
    <Link
      to={`/shows/${show.category_show.name}/${show.id}`}
      className="card__link"
    >
      <article className="card">
        <img src={imageUrl} alt="" className="card__image" loading="lazy" />

        {withQuality && <span className="card__quality">{show.quality}</span>}

        <h3 className="card__title">{show.title}</h3>

        {info && (
          <p className="card__info">
            {new Date(show.release_date).getFullYear()} · {infoText}
          </p>
        )}
      </article>
    </Link>
  );
}
