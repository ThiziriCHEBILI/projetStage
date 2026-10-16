import type { Show } from "../Types";
import { API_URL } from "./fetchApi";

export function imageUrl(show: Show): string {
  if (!show.category_show) {
    return show.image_show;
  }
  return `${API_URL}/images/${show.category_show.name}/${show.image_show}`;
}