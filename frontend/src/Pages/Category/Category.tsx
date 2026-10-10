import { useState } from "react";
import type { JSX } from "react";
import type { CategoryPage } from "../../Types";
import { ShowCard } from "../../components/ShowCard/ShowCard";
import { TypeFilters } from "../../components/TypeFilters/TypeFilters";
import { Pagination } from "../../components/Pagination/Pagination";
import "./Category.scss";

const SHOWS_MAX = 8;

interface CategoryProps {
  page: CategoryPage;
}

export default function Category({ page }: CategoryProps): JSX.Element {
  const [activeType, setActiveType] = useState("");
  const [currentPage, setCurrentPage] = useState(1);

  const filteredShows =
    activeType === ""
      ? page.shows
      : page.shows.filter((show) => show.type_show === activeType);

  const totalPages = Math.ceil(filteredShows.length / SHOWS_MAX);

  const currentShows = filteredShows.slice(
    (currentPage - 1) * SHOWS_MAX,
    currentPage * SHOWS_MAX,
  );

  function selectType(type: string): void {
    setActiveType(type);
    setCurrentPage(1);
  }
  function selectPage(page: number): void {
  setCurrentPage(page);
  window.scrollTo({ top: 0, behavior: "smooth" });
}

  return (
    <section className="category">
      <h1 className="category__title">{page.title}</h1>
      <p className="category__desc">{page.desc}</p>

      <TypeFilters activeType={activeType} onSelect={selectType} />

      {currentShows.length > 0 ? (
        <div className="category__grid">
          {currentShows.map((show) => (
            <ShowCard
              key={show.id}
              show={show}
              withQuality={true}
              info="type_show"
            />
          ))}
        </div>
      ) : (
        <p className="category__empty">
          Aucun titre de ce type pour le moment.
        </p>
      )}

      {totalPages > 1 && (
        <Pagination
          currentPage={currentPage}
          totalPages={totalPages}
          onSelect={selectPage}
        />
      )}
    </section>
  );
}
