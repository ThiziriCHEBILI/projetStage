// Données reçues de l'API
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
  episode_number: number | null;
  saison_number: number | null;
  video_quality: string;
  duration: number;
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

export interface ProgressVideo extends Omit<ShowVideo, "video_quality"> {
  show: Show;
}

export interface UserProgress {
  watched_seconds: number;
  last_watched: string;
  show_video: ProgressVideo;
}

// Affichage : sections et pages
export type Info = "type_show" | "saison";

export interface Section {
  title: string;
  desc?: string;
  seeAll?: string;
  withQuality?: boolean;
  info?: Info;
}

export interface CategoryPage {
  name: string;
  title: string;
  desc: string;
}
