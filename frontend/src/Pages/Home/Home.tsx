import { useState } from "react";
import type { JSX } from "react";
import { Hero } from "../../components/Hero/Hero";
import { ShowRow } from "../../components/ShowRow/ShowRow";
import { ShowCard } from "../../components/ShowCard/ShowCard";
import { ProgressCard } from "../../components/ProgressCard/ProgressCard";
import { TopCard } from "../../components/TopCard/TopCard";
import { isRecent } from "../../utilities/convert";
import { useFetch } from "../../utilities/useFetch";
import type { Show, PaginatedShows } from "../../Types/ApiType";
import { trendingSection, seriesSection, progressList } from "../../data/data";
import "./Home.scss";

const DAYS_BEFORE_REMOVE = 30;

export default function Home(): JSX.Element {
  const { data: heroShows } = useFetch<Show[]>("shows/a-la-une");
  const { data: trendingShows } =
    useFetch<PaginatedShows>("shows/films?page=1");
  const [continueWatching, setContinueWatching] = useState(
    progressList.filter((progress) =>
      isRecent(progress.lastWatched, DAYS_BEFORE_REMOVE),
    ),
  );
  const { data: topShows } = useFetch<PaginatedShows>(
    "shows/dessins-animes?page=1",
  );
  const { data: seriesShows } = useFetch<PaginatedShows>("shows/series?page=1");

  function removeFromList(videoId: number): void {
    setContinueWatching(
      continueWatching.filter((progress) => progress.video.id !== videoId),
    );
  }

  return (
    <>
      {heroShows && heroShows.length > 0 && <Hero shows={heroShows} />}

      {continueWatching.length > 0 && (
        <ShowRow
          titleSec="Reprendre votre lecture"
          seeAll="/shows/reprendre"
          cards={continueWatching.map((progress) => (
            <ProgressCard
              key={progress.video.id}
              progress={progress}
              onRemove={removeFromList}
            />
          ))}
        />
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
    </>
  );
}
