import { useState, type JSX } from "react";
import type { PaginatedShows, CategoryName } from "../../Types";
import { useFetch } from "../../utilities/useFetch";
import { ShowCard } from "../../components/ShowCard/ShowCard";
import { TypeFilters } from "../../components/TypeFilters/TypeFilters";
import { Pagination } from "../../components/Pagination/Pagination";
import { DataLoader } from "../../components/DataLoader/DataLoader";
import "./Category.scss";

const categoryTexts: Record<CategoryName, { title: string; desc: string }> = {
  films: {
    title: "Films",
    desc: "Découvrez notre sélection de films incontournables : des dernières nouveautés aux grands classiques, en passant par la science-fiction, l'action et le thriller. Trouvez votre prochain film préféré en quelques clics.",
  },
  series: {
    title: "Séries",
    desc: "Plongez dans nos séries à dévorer : thrillers haletants, drames intenses et frissons garantis. Un épisode en appelle toujours un autre.",
  },
  "dessins-animes": {
    title: "Dessins animés",
    desc: "Des aventures pour tous les âges : mondes imaginaires, héros attachants et grands voyages. À regarder seul ou en famille.",
  },
};

interface CategoryProps {
  name: CategoryName;
}

export default function Category({ name }: CategoryProps): JSX.Element {
  const [activeType, setActiveType] = useState("");
  const [currentPage, setCurrentPage] = useState(1);
  const { title, desc } = categoryTexts[name];

  const endpoint =
    activeType === ""
      ? `shows/${name}?page=${currentPage}`
      : `shows/${name}?page=${currentPage}&type=${activeType}`;

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
      <h1 className="category__title">{title}</h1>
      <p className="category__desc">{desc}</p>

      <div className="category__types">
        <TypeFilters activeType={activeType} onSelect={selectType} />
      </div>

      <DataLoader
        loading={loading}
        error={error}
        isEmpty={data?.shows.length === 0}
        emptyMessage="Aucun titre de ce type pour le moment."
      >
        <div className="category__grid">
          {data?.shows.map((show) => (
            <ShowCard
              key={show.id}
              show={show}
              withQuality={true}
              info="type_show"
            />
          ))}
        </div>

        {data && data.totalPages > 1 && (
          <Pagination
            currentPage={currentPage}
            totalPages={data.totalPages}
            onSelect={selectPage}
          />
        )}
      </DataLoader>
    </section>
  );
}
