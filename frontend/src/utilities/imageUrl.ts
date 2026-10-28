import type { Show } from "../Types";
import { API_URL } from "./fetchApi";

export function imageUrl(show: Show, file: string): string {
  return `${API_URL}/images/${show.category_show.name}/${file}`;
}
