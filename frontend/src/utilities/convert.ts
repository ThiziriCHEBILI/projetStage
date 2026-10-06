import type { ShowVideo } from "../Types";

export function formatSaisons(nombre: number): string {
  if (nombre > 1) {
    return nombre + " saisons";
  }
  return nombre + " saison";
}

export function nombreDeSaisons(videos: ShowVideo[]): number {
  let max = 0;
  for (const video of videos) {
    if (video.saisonNumber > max) {
      max = video.saisonNumber;
    }
  }
  return max;
}