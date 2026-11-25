import { useEffect, useState } from "react";
import { fetchAPI } from "./fetchApi";
import type { Show } from "../Types";

const SEARCH_DELAY = 300;

export function useSearchSuggestions(searchText: string): Show[] {
  const [suggestions, setSuggestions] = useState<Show[]>([]);
  const query = searchText.trim();

  useEffect(() => {
    if (!query) {
      return;
    }

    let ignore = false;

    const timer = setTimeout(async () => {
      const response = await fetchAPI<Show[]>(
        `shows/search?q=${encodeURIComponent(query)}`,
      );

      if (ignore) {
        return;
      }

      setSuggestions(Array.isArray(response) ? response : []);
    }, SEARCH_DELAY);

    return () => {
      ignore = true;
      clearTimeout(timer);
    };
  }, [query]);

  return query ? suggestions : [];
}
