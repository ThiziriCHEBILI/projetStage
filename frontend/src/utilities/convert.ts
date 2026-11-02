export function formatSeasons(count: number): string {
  if (count > 1) {
    return count + " saisons";
  }
  return count + " saison";
}

export function formatEpisode(season: number, episode: number): string {
  return "S" + season + "E" + episode;
}

export function formatSeconds(totalSeconds: number): string {
  const hours = Math.floor(totalSeconds / 3600);
  const minutes = Math.floor((totalSeconds % 3600) / 60);
  const seconds = totalSeconds % 60;

  if (hours > 0) {
    return hours + " h " + minutes + " min";
  }
  if (minutes > 0) {
    return minutes + " min";
  }
  return seconds + " s";
}

export function getYoutubeIdFromUrl(url: string): string | null {
  try {
    return new URL(url).searchParams.get("v");
  } catch {
    return null;
  }
}

export function loginUrl(path: string): string {
  return `/login?redirect=${encodeURIComponent(path)}`;
}
