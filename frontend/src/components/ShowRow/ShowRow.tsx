import type { JSX } from "react";
import { Link } from "react-router";
import type { Show, Info } from "../../Types";
import { ShowCard } from "../ShowCard/ShowCard";
import "./ShowRow.scss";

interface ShowRowProps {
  titleSec: string;
  desc?: string;
  shows: Show[];
  seeAll?: string;
  withQuality?: boolean;
  info?: Info;
}

export function ShowRow({
  titleSec,
  desc,
  shows,
  seeAll,
  withQuality,
  info,
}: ShowRowProps): JSX.Element {
  return (
    <section className="row">
      <div className="row__header">
        <h2 className="row__title">
          {titleSec}
          <i className="fa-solid fa-chevron-right" aria-hidden="true"></i>
        </h2>
        {seeAll && (
          <Link to={seeAll} className="row__seeall">
            Tout voir
          </Link>
        )}
      </div>

      {desc && <p className="row__desc">{desc}</p>}

      <div className="row__cards">
        {shows.map((show) => (
          <ShowCard
            key={show.id}
            show={show}
            withQuality={withQuality}
            info={info}
          />
        ))}
      </div>
    </section>
  );
}
