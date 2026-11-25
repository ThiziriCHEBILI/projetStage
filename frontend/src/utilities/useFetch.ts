import { useEffect, useState } from "react";
import { fetchAPI } from "./fetchApi";

export function useFetch<T extends object>(endpoint: string) {
  const [data, setData] = useState<T | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    fetchAPI<T>(endpoint)
      .then((response) => {
        if (response === undefined) {
          setError("Une erreur s'est produite. Veuillez réessayer.");
          setData(null);
        } else if ("message" in response) {
          setError("Impossible d'afficher cette page. Réessayez plus tard.");
          setData(null);
        } else {
          setError(null);
          setData(response);
        }
      })
      .finally(() => setLoading(false));
  }, [endpoint]);

  return { data, loading, error };
}
