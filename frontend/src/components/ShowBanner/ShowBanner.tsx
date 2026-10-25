import type { JSX } from "react";
import { imageUrl } from "../../utilities/imageUrl";
import { formatSeasons } from "../../utilities/convert";
import type { ShowDetail } from "../../Types/ApiType";
import "./ShowBanner.scss";

interface ShowBannerProps {
  show: ShowDetail;
  canPlay: boolean;
  onPlay: () => void;
  inMyList: boolean;
  listLoading: boolean;
  onListClick: () => void;
}

export function ShowBanner({
  show,
  canPlay,
  onPlay,
  inMyList,
  listLoading,
  onListClick,
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

            <button
              type="button"
              className="banner__add"
              onClick={onListClick}
              disabled={listLoading}
            >
              <i
                className={
                  inMyList ? "fa-solid fa-heart" : "fa-regular fa-heart"
                }
                aria-hidden="true"
              ></i>
              {inMyList ? "Retirer de ma liste" : "Ajouter à ma liste"}
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}
