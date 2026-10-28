import type { JSX } from "react";
import { Hero } from "../../components/Hero/Hero";
import { ShowRow } from "../../components/ShowRow/ShowRow";
import { ShowCard } from "../../components/ShowCard/ShowCard";
import { ProgressCard } from "../../components/ProgressCard/ProgressCard";
import { TopCard } from "../../components/TopCard/TopCard";
import { useFetch } from "../../utilities/useFetch";
import type { Show, PaginatedShows } from "../../Types/ApiType";
import { trendingSection, seriesSection } from "../../data/data";
import { useProgress } from "../../utilities/useProgress";
import { useVideoPlayer } from "../../utilities/useVideoPlayer";
import { VideoModal } from "../../components/VideoModal/VideoModal";
import { useMyList } from "../../utilities/useMyList";
import "./Home.scss";

export default function Home(): JSX.Element {
  const { data: heroShows } = useFetch<Show[]>("shows/a-la-une");
  const { data: trendingShows } =
    useFetch<PaginatedShows>("shows/films?page=1");
  const { progressList, removeProgress } = useProgress();
  const { isInList, addToMyList, removeFromMyList } = useMyList();
  const { playing, play, close, playError, saveProgress } = useVideoPlayer();
  const { data: topShows } = useFetch<PaginatedShows>(
    "shows/dessins-animes?page=1",
  );
  const { data: seriesShows } = useFetch<PaginatedShows>("shows/series?page=1");

  function handleListClick(show: Show): void {
    if (isInList(show.id)) {
      removeFromMyList(show.id);
    } else {
      addToMyList(show);
    }
  }

  return (
    <>
      {heroShows && heroShows.length > 0 && <Hero shows={heroShows} />}

      {progressList.length > 0 && (
        <ShowRow
          key={progressList.length}
          titleSec="Reprendre votre lecture"
          cards={progressList.map((progress) => (
            <ProgressCard
              key={progress.show_video.id}
              progress={progress}
              inMyList={isInList(progress.show_video.show.id)}
              onPlay={play}
              onListClick={() => handleListClick(progress.show_video.show)}
              onRemove={removeProgress}
            />
          ))}
        />
      )}

      {playError && (
        <p className="home__error" role="alert">
          {playError}
        </p>
      )}

      {trendingShows && (
        <ShowRow
          titleSec={trendingSection.title}
          desc={trendingSection.desc}
          seeAll={trendingSection.seeAll}
          cards={trendingShows.shows.map((show) => (
            <ShowCard
              key={show.id}
              show={show}
              withQuality={trendingSection.withQuality}
              info={trendingSection.info}
            />
          ))}
        />
      )}

      {topShows && (
        <ShowRow
          titleSec="Top 5 aujourd'hui"
          maxCards={5}
          cards={topShows.shows.slice(0, 5).map((show, index) => (
            <TopCard key={show.id} show={show} position={index + 1} />
          ))}
        />
      )}

      {seriesShows && (
        <ShowRow
          titleSec={seriesSection.title}
          desc={seriesSection.desc}
          seeAll={seriesSection.seeAll}
          cards={seriesShows.shows.map((show) => (
            <ShowCard
              key={show.id}
              show={show}
              withQuality={seriesSection.withQuality}
              info={seriesSection.info}
            />
          ))}
        />
      )}

      {playing && (
        <VideoModal
          youtubeId={playing.youtubeId}
          title={playing.title}
          startAt={playing.startAt}
          onSave={saveProgress}
          onClose={close}
        />
      )}
    </>
  );
}
