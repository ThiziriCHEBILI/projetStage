import type { JSX } from "react";
import { imageUrl } from "../../utilities/imageUrl";
import { formatSeasons } from "../../utilities/convert";
import type { ShowDetail } from "../../Types/ApiType";
import "./ShowBanner.scss";

interface ShowBannerProps {
  show: ShowDetail;
  canPlay: boolean;
  onPlay: () => void;
}

export function ShowBanner({
  show,
  canPlay,
  onPlay,
}: ShowBannerProps): JSX.Element {
  return (
    <div className="banner">
      <img
        src={imageUrl(show, show.image_show)}
        alt=""
        className="banner__background"
      />

      <div className="banner__content">
        <img
          src={imageUrl(show, show.image_poster)}
          alt=""
          className="banner__poster"
        />

        <div className="banner__infos">
          <h1 className="banner__title">{show.title}</h1>

          <p className="banner__meta">
            {new Date(show.release_date).getFullYear()}
            {show.season_count !== null &&
              ` · ${formatSeasons(show.season_count)}`}
            {show.quality && ` · ${show.quality}`}
          </p>

          <p className="banner__description">{show.description}</p>

          {show.type_show && (
            <span className="banner__tag">{show.type_show}</span>
          )}

          <div className="banner__actions">
            <button
              type="button"
              className="banner__play"
              onClick={onPlay}
              disabled={!canPlay}
            >
              <i className="fa-solid fa-play" aria-hidden="true"></i>
              Voir la bande-annonce
            </button>

            <button type="button" className="banner__add">
              <i className="fa-solid fa-plus" aria-hidden="true"></i>
              Ajouter à ma liste
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}
