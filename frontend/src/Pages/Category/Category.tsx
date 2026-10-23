import { useState } from "react";
import type { JSX } from "react";
import type { CategoryPage } from "../../Types";
import type { PaginatedShows } from "../../Types/ApiType";
import { useFetch } from "../../utilities/useFetch";
import { ShowCard } from "../../components/ShowCard/ShowCard";
import { TypeFilters } from "../../components/TypeFilters/TypeFilters";
import { Pagination } from "../../components/Pagination/Pagination";
import "./Category.scss";

interface CategoryProps {
  page: CategoryPage;
}

export default function Category({ page }: CategoryProps): JSX.Element {
  const [activeType, setActiveType] = useState("");
  const [currentPage, setCurrentPage] = useState(1);

  const endpoint =
    activeType === ""
      ? `shows/${page.name}?page=${currentPage}`
      : `shows/${page.name}?page=${currentPage}&type=${activeType}`;

  const { data, loading, error } = useFetch<PaginatedShows>(endpoint);

  function selectType(type: string): void {
    setActiveType(type);
    setCurrentPage(1);
  }

  function selectPage(pageNumber: number): void {
    setCurrentPage(pageNumber);
    window.scrollTo({ top: 0, behavior: "smooth" });
  }

  return (
    <section className="category">
      <h1 className="category__title">{page.title}</h1>
      <p className="category__desc">{page.desc}</p>

      <div className="category__types">
        <TypeFilters activeType={activeType} onSelect={selectType} />
      </div>

      {loading && <p className="category__empty">Chargement…</p>}

      {error && <p className="category__empty">{error}</p>}

      {data && data.shows.length > 0 && (
        <div className="category__grid">
          {data.shows.map((show) => (
            <ShowCard
              key={show.id}
              show={show}
              withQuality={true}
              info="type_show"
            />
          ))}
        </div>
      )}

      {data && data.shows.length === 0 && (
        <p className="category__empty">
          Aucun titre de ce type pour le moment.
        </p>
      )}

      {data && data.totalPages > 1 && (
        <Pagination
          currentPage={currentPage}
          totalPages={data.totalPages}
          onSelect={selectPage}
        />
      )}
    </section>
  );
}
