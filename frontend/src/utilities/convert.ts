export function formatSeasons(count: number): string {
  if (count > 1) {
    return count + " saisons";
  }
  return count + " saison";
}

export function formatEpisode(season: number, episode: number): string {
  return "S" + season + "E" + episode;
}

export function formatDuration(duration: string): string {
  const parts = duration.split(":");
  const hours = Number(parts[0]);
  const minutes = Number(parts[1]);

  if (hours > 0) {
    return hours + " h " + minutes + " min";
  }
  return minutes + " min";
}

function toSeconds(duration: string): number {
  const parts = duration.split(":");
  return Number(parts[0]) * 3600 + Number(parts[1]) * 60 + Number(parts[2]);
}

export function watchedPercent(remaining: string, total: string): number {
  const remainingSeconds = toSeconds(remaining);
  const totalSeconds = toSeconds(total);
  const watchedSeconds = totalSeconds - remainingSeconds;
  return (watchedSeconds / totalSeconds) * 100;
}

export function isRecent(date: string, days: number): boolean {
  const limit = new Date();
  limit.setDate(limit.getDate() - days);

  return new Date(date) > limit;
}