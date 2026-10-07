import { useState } from "react";
import type { JSX } from "react";
import { ShowRow } from "../../components/ShowRow/ShowRow";
import { ShowCard } from "../../components/ShowCard/ShowCard";
import { ProgressCard } from "../../components/ProgressCard/ProgressCard";
import { sections, progressList } from "../../data/data";
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
      <ShowRow titleSec="Reprendre votre lecture" seeAll="/shows/reprendre">
        {continueWatching.map((progress) => (
          <ProgressCard
            key={progress.video.id}
            progress={progress}
            onRemove={removeFromList}
          />
        ))}
      </ShowRow>

      {sections.map((section) => (
        <ShowRow
          key={section.id}
          titleSec={section.title}
          desc={section.desc}
          seeAll={section.seeAll}
        >
          {section.shows.map((show) => (
            <ShowCard
              key={show.id}
              show={show}
              withQuality={section.withQuality}
              info={section.info}
            />
          ))}
        </ShowRow>
      ))}
    </>
  );
}
