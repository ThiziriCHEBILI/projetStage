import type { JSX } from "react";
import "./Pagination.scss";

interface PaginationProps {
  currentPage: number;
  totalPages: number;
  onSelect: (page: number) => void;
}

export function Pagination({
  currentPage,
  totalPages,
  onSelect,
}: PaginationProps): JSX.Element {
  const pages = Array.from({ length: totalPages }, (_, index) => index + 1);

  return (
    <nav className="pagination" aria-label="Pagination">
      {pages.map((page) => (
        <button
          key={page}
          type="button"
          className={`pagination__button ${page === currentPage ? "pagination__button--active" : ""}`}
          onClick={() => onSelect(page)}
        >
          {page}
        </button>
      ))}
    </nav>
  );
}
