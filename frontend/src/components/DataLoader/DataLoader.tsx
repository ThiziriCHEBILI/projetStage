import type { JSX, ReactNode } from "react";
import "./DataLoader.scss";

interface DataLoaderProps {
  loading: boolean;
  error?: string | null;
  isEmpty?: boolean;
  emptyMessage?: string;
  children?: ReactNode;
}

export function DataLoader({
  loading,
  error,
  isEmpty = false,
  emptyMessage = "Aucun résultat.",
  children,
}: DataLoaderProps): JSX.Element {
  if (loading) {
    return (
      <p className="data-loader" role="status">
        Chargement…
      </p>
    );
  }

  if (error) {
    return (
      <p className="data-loader" role="alert">
        {error}
      </p>
    );
  }

  if (isEmpty) {
    return <p className="data-loader">{emptyMessage}</p>;
  }

  return <>{children}</>;
}
