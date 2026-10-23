import type { JSX } from "react";
import { useState } from "react";
import { useParams } from "react-router";
import type { ShowDetail } from "../../Types/ApiType";
import { useFetch } from "../../utilities/useFetch";
import { VideoModal } from "../../components/VideoModal/VideoModal";
import { useVideoPlayer } from "../../utilities/useVideoPlayer";
import { EpisodeCard } from "../../components/EpisodeCard/EpisodeCard";
import { SeasonButtons } from "../../components/SeasonButtons/SeasonButtons";
import { ShowBanner } from "../../components/ShowBanner/ShowBanner";
import "./Show.scss";

export default function Show(): JSX.Element {
  const { name, id } = useParams();
  const { data, loading, error } = useFetch<ShowDetail>(`shows/${name}/${id}`);
  const [season, setSeason] = useState(1);
  const [switching, setSwitching] = useState(false);
  const { playing, play, close, playError } = useVideoPlayer();

  function selectSeason(number: number): void {
    setSeason(number);
    setSwitching(true);
    setTimeout(() => setSwitching(false), 1000);
  }

  if (loading) {
    return <p>Chargement...</p>;
  }

  if (error || !data) {
    return <p>Ce titre est introuvable.</p>;
  }

  const seasons: number[] = [];
  for (let i = 1; i <= (data.season_count ?? 0); i++) {
    seasons.push(i);
  }

  const episodes = data.showVideos.filter(
    (video) => video.episode_number !== null && video.saison_number === season,
  );

  const bannerVideo = data.showVideos.find(
    (video) =>
      video.episode_number === null &&
      (seasons.length === 0 || video.saison_number === season),
  );

  return (
    <section className="show">
      <ShowBanner
        show={data}
        canPlay={Boolean(bannerVideo)}
        onPlay={() => bannerVideo && play(bannerVideo.id, data.title)}
      />

      {playError && (
        <p className="show__error" role="alert">
          {playError}
        </p>
      )}

      {seasons.length > 0 && (
        <div className="show__seasons">
          <SeasonButtons
            seasons={seasons}
            season={season}
            onSelect={selectSeason}
          />
        </div>
      )}

      {seasons.length > 0 && (
        <div className="show__episodes">
          <h2 className="show__heading">Épisodes</h2>

          {switching ? (
            <div
              className="show__dots"
              role="status"
              aria-label="Chargement des épisodes"
            >
              <span className="show__dot"></span>
              <span className="show__dot"></span>
              <span className="show__dot"></span>
            </div>
          ) : (
            <div className="show__list">
              {episodes.length > 0 && (
                <ul className="show__grid">
                  {episodes.map((episode) => (
                    <EpisodeCard
                      key={episode.id}
                      episode={episode}
                      show={data}
                      season={season}
                      onPlay={play}
                    />
                  ))}
                </ul>
              )}

              {episodes.length === 0 && (
                <p className="show__empty">
                  Aucun épisode disponible pour cette saison.
                </p>
              )}
            </div>
          )}
        </div>
      )}

      {playing && (
        <VideoModal url={playing.url} title={playing.title} onClose={close} />
      )}
    </section>
  );
}
