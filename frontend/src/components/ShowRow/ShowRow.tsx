import type { JSX, ReactNode } from "react";
import { Link } from "react-router";
import "./ShowRow.scss";

interface ShowRowProps {
  titleSec: string;
  desc?: string;
  seeAll?: string;
  children: ReactNode;
}

export function ShowRow({
  titleSec,
  desc,
  seeAll,
  children,
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

      <div className="row__cards">{children}</div>
    </section>
  );
}