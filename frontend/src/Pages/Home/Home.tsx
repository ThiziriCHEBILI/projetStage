import "./Home.scss";
import type { JSX } from "react";
import { ShowRow } from "../../components/ShowRow/ShowRow";
import { sections } from "../../data/data";

export default function Home(): JSX.Element {
  return (
    <>
      {sections.map((section) => (
        <ShowRow
          key={section.id}
          titleSec={section.title}
          desc={section.desc}
          shows={section.shows}
          seeAll={section.seeAll}
          withQuality={section.withQuality}
          info={section.info}
        />
      ))}
    </>
  );
}
