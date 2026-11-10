import { useState, type JSX } from "react";
import { Link } from "react-router";
import type { UserProgress } from "../../Types";
import { formatSeasonEpisode, formatSeconds } from "../../utilities/convert";
import { smallImageUrl } from "../../utilities/imageUrl";
import "./ProgressCard.scss";

interface ProgressCardProps {
  progress: UserProgress;
  inMyList: boolean;
  onPlay: (videoId: number, title: string) => void;
  onListClick: () => void;
  onRemove: (videoId: number) => void;
}

export function ProgressCard({
  progress,
  inMyList,
  onPlay,
  onListClick,
  onRemove,
}: ProgressCardProps): JSX.Element {
  const [listOpen, setListOpen] = useState(false);

  const video = progress.show_video;
  const show = video.show;
  const percent = (progress.watched_seconds / video.duration) * 100;
  const remaining = video.duration - progress.watched_seconds;
  const image = smallImageUrl(show, video.image_video);

  let videoInfo = "Film | ";
  if (video.saison_number !== null && video.episode_number !== null) {
    videoInfo =
      formatSeasonEpisode(video.saison_number, video.episode_number) + " | ";
  }

  return (
    <article className="progress">
      <div className="progress__visual">
        <img src={image} alt="" className="progress__image" loading="lazy" />

        <button
          type="button"
          className="progress__play"
          aria-label={"Reprendre " + show.title}
          onClick={() => onPlay(video.id, show.title)}
        >
          <i className="fa-solid fa-play" aria-hidden="true"></i>
        </button>

        <div className="progress__bar">
          <div
            className="progress__fill"
            style={{ width: percent + "%" }}
          ></div>
        </div>
      </div>

      <div className="progress__footer">
        <h3 className="progress__title">{show.title}</h3>

        <div className="progress__list">
          <button
            type="button"
            className="progress__more"
            aria-label="Plus d'options"
            aria-expanded={listOpen}
            onClick={() => setListOpen(!listOpen)}
          >
            <i className="fa-solid fa-ellipsis" aria-hidden="true"></i>
          </button>

          {listOpen && (
            <>
              <div
                className="progress__backdrop"
                onClick={() => setListOpen(false)}
              ></div>

              <ul className="progress__options">
                <li>
                  <button
                    type="button"
                    className="progress__option"
                    onClick={onListClick}
                  >
                    {inMyList ? "Retirer de Ma Liste" : "Ajouter à Ma Liste"}
                  </button>
                </li>
                <li>
                  <button
                    type="button"
                    className="progress__option"
                    onClick={() => onRemove(video.id)}
                  >
                    Masquer cette vidéo
                  </button>
                </li>
                <li>
                  <Link
                    to={`/shows/${show.category_show.name}/${show.id}`}
                    className="progress__option"
                  >
                    Plus d'infos sur le titre
                  </Link>
                </li>
              </ul>
            </>
          )}
        </div>
      </div>

      <p className="progress__info">
        {videoInfo}
        {formatSeconds(video.duration)} · {formatSeconds(remaining)} restants
      </p>
    </article>
  );
}
