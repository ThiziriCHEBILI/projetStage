import { useState } from "react";
import type { JSX } from "react";
import { Link } from "react-router";
import type { Progress } from "../../Types";
import {
  formatEpisode,
  formatDuration,
  watchedPercent,
} from "../../utilities/convert";
import "./ProgressCard.scss";

interface ProgressCardProps {
  progress: Progress;
  onRemove: (id: number) => void;
}

export function ProgressCard({
  progress,
  onRemove,
}: ProgressCardProps): JSX.Element {
  const [menuOpen, setMenuOpen] = useState(false);

  const show = progress.show;
  const video = progress.video;
  const percent = watchedPercent(progress.remainingDuration, video.duration);

  return (
    <article className="progress">
      <div className="progress__visual">
        <img src={video.image} alt="" className="progress__image" />

        <button
          type="button"
          className="progress__play"
          aria-label={"Reprendre " + show.title}
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

        <div className="progress__menu">
          <button
            type="button"
            className="progress__more"
            aria-label="Plus d'options"
            aria-expanded={menuOpen}
            onClick={() => setMenuOpen(!menuOpen)}
          >
            <i className="fa-solid fa-ellipsis" aria-hidden="true"></i>
          </button>

          {menuOpen && (
            <>
              <div
                className="progress__backdrop"
                onClick={() => setMenuOpen(false)}
              ></div>

              <ul className="progress__options">
                <li>
                  <button type="button" className="progress__option">
                    Ajouter à Ma Liste
                  </button>
                </li>
                <li>
                  <button
                    type="button"
                    className="progress__option"
                    onClick={() => onRemove(video.id)}
                  >
                    Retirer de la liste
                  </button>
                </li>
                <li>
                  <Link to={"/show/" + show.id} className="progress__option">
                    Plus d'infos sur le titre
                  </Link>
                </li>
              </ul>
            </>
          )}
        </div>
      </div>

      <p className="progress__info">
        {formatEpisode(video.saisonNumber, video.episodeNumber)} —{" "}
        {formatDuration(video.duration)} ·{" "}
        {formatDuration(progress.remainingDuration)} restants
      </p>
    </article>
  );
}
