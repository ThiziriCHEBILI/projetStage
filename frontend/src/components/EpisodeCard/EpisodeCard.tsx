import type { JSX } from "react";
import { formatSeconds } from "../../utilities/convert";
import { imageUrl } from "../../utilities/imageUrl";
import type { ShowVideo, ShowDetail } from "../../Types";
import "./EpisodeCard.scss";

interface EpisodeCardProps {
  episode: ShowVideo;
  show: ShowDetail;
  season: number;
  onPlay: (videoId: number, title: string) => void;
}

export function EpisodeCard({
  episode,
  show,
  season,
  onPlay,
}: EpisodeCardProps): JSX.Element {
  return (
    <li className="episode">
      <button
        type="button"
        className="episode__button"
        onClick={() =>
          onPlay(
            episode.id,
            `${show.title} - Saison ${season}, Épisode ${episode.episode_number}`,
          )
        }
      >
        <span className="episode__thumb">
          <img
            src={imageUrl(show, episode.image_video)}
            alt=""
            className="episode__image"
          />
          <span className="episode__quality">{episode.video_quality}</span>
          <span className="episode__duration">
            {formatSeconds(episode.duration)}
          </span>
        </span>

        <span className="episode__title">Épisode {episode.episode_number}</span>
      </button>
    </li>
  );
}
