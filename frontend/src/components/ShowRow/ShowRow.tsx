import { useState } from "react";
import type { JSX, ReactNode } from "react";
import { Link } from "react-router";
import "./ShowRow.scss";

interface ShowRowProps {
  titleSec: string;
  desc?: string;
  seeAll?: string;
  maxCards?: number;
  cards: ReactNode[];
}

export function ShowRow({
  titleSec,
  desc,
  seeAll,
  maxCards = 4,
  cards,
}: ShowRowProps): JSX.Element {
  const [page, setPage] = useState(0);

  const totalPages = Math.ceil(cards.length / maxCards);

  const next = () => {
    if (page < totalPages - 1) {
      setPage(page + 1);
    }
  };

  const previous = () => {
    if (page > 0) {
      setPage(page - 1);
    }
  };

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

      <div className="row__strip">
        {page > 0 && (
          <button
            type="button"
            className="row__arrow row__arrow--left"
            aria-label="Page précédente"
            onClick={previous}
          >
            <i className="fa-solid fa-circle-chevron-left" aria-hidden="true"></i>
          </button>
        )}

        <div className="row__cards">
          {cards.slice(page * maxCards, page * maxCards + maxCards + 1)}
        </div>

        {page < totalPages - 1 && (
          <button
            type="button"
            className="row__arrow row__arrow--right"
            aria-label="Page suivante"
            onClick={next}
          >
            <i className="fa-solid fa-circle-chevron-right" aria-hidden="true"></i>
          </button>
        )}
      </div>
    </section>
  );
}
