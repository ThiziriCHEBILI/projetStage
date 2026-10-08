import { useState } from "react";
import type { JSX } from "react";
import { Hero } from "../../components/Hero/Hero";
import { ShowRow } from "../../components/ShowRow/ShowRow";
import { ShowCard } from "../../components/ShowCard/ShowCard";
import { ProgressCard } from "../../components/ProgressCard/ProgressCard";
import { TopCard } from "../../components/TopCard/TopCard";
import {
  heroShows,
  trendingSection,
  seriesSection,
  progressList,
  topShows,
} from "../../data/data";
import "./Home.scss";

export default function Home(): JSX.Element {
  const [continueWatching, setContinueWatching] = useState(progressList);

  function removeFromList(videoId: number): void {
    setContinueWatching(
      continueWatching.filter((progress) => progress.video.id !== videoId),
    );
  }

  return (
    <>
      <Hero shows={heroShows} />
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

      <ShowRow
        titleSec={trendingSection.title}
        desc={trendingSection.desc}
        seeAll={trendingSection.seeAll}
        cards={trendingSection.shows.map((show) => (
          <ShowCard
            key={show.id}
            show={show}
            withQuality={trendingSection.withQuality}
            info={trendingSection.info}
          />
        ))}
      />

      <ShowRow
        titleSec="Top 5 aujourd'hui"
        maxCards={5}
        cards={topShows.map((show, index) => (
          <TopCard key={show.id} show={show} position={index + 1} />
        ))}
      />

      <ShowRow
        titleSec={seriesSection.title}
        desc={seriesSection.desc}
        seeAll={seriesSection.seeAll}
        cards={seriesSection.shows.map((show) => (
          <ShowCard
            key={show.id}
            show={show}
            withQuality={seriesSection.withQuality}
            info={seriesSection.info}
          />
        ))}
      />
    </>
  );
}
