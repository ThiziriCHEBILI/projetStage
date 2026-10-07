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
  type_show: string;
  image_show: string;
  seasonCount: number;
  bestQuality: string;
}

export interface Section {
  id: number;
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
}
