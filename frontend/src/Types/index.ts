export type Info = "type_show" | "saison";

export interface ShowVideo {
  id: number;
  descriptionVideo: string;
  image: string;
  episodeNumber: number;
  saisonNumber: number;
  videoQuality: string;
  duration: string;
}
export interface Show {
  id: number;
  title: string;
  description: string;
  release_date: string;
  type_show: string | null;
  image_show: string;
  image_poster: string;
  season_count: number | null;
  quality: string | null;
  award?: string | null;
  category_show?: { id: number; name: string };
}

export interface Section {
  title: string;
  desc?: string;
  seeAll?: string;
  withQuality?: boolean;
  info?: Info;
  shows: Show[];
}

export interface Progress {
  show: Show;
  video: ShowVideo;
  remainingDuration: string;
  lastWatched: string;
}

export interface CategoryPage {
  name: string;
  title: string;
  desc: string;
  shows: Show[];
}
