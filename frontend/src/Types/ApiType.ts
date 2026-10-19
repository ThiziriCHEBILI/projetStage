export type TypeShow =
  | "sci-fi"
  | "drame"
  | "thriller"
  | "aventure"
  | "action"
  | "horreur";

export interface Category {
  id: number;
  name: string;
}

export interface Show {
  id: number;
  title: string;
  description: string;
  date_publication: string;
  release_date: string;
  category_show: Category;
  award: "award winner" | null;
  type_show: TypeShow | null;
  image_show: string;
  image_poster: string;
  season_count: number | null;
  quality: string | null;
}

export interface ShowVideo {
  id: number;
  description_video: string;
  image_video: string;
  url_video: string;
  episode_number: number | null;
  saison_number: number | null;
  video_quality: string;
  duration: string;
}

export interface ShowDetail extends Show {
  showVideos: ShowVideo[];
}

export interface PaginatedShows {
  shows: Show[];
  page: number;
  limit: number;
  total: number;
  totalPages: number;
}

export interface User {
  id: number;
  name: string;
  surname: string;
  email: string;
  date_registration: string;
}