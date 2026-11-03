import { useEffect, useState } from "react";
import { useAuth } from "../context/useAuth";
import { useNavigate, useLocation } from "react-router";
import { fetchAPI, fetchAPIWithStatus } from "./fetchApi";
import { getYoutubeIdFromUrl, loginUrl } from "./convert";

export function useVideoPlayer(onSaved?: () => void) {
  const [playing, setPlaying] = useState<{
    videoId: number;
    youtubeId: string;
    title: string;
    startAt: number;
  } | null>(null);
  const [playError, setPlayError] = useState<string | null>(null);
  const { user } = useAuth();
  const navigate = useNavigate();
  const location = useLocation();

  useEffect(() => {
    if (!playError) {
      return;
    }

    const timer = setTimeout(() => setPlayError(null), 4000);

    return () => clearTimeout(timer);
  }, [playError]);

  async function play(videoId: number, title: string): Promise<void> {
    if (!user) {
      navigate(loginUrl(location.pathname));
      return;
    }

    const response = await fetchAPI<{
      url_video?: string;
      watched_seconds?: number;
    }>(`videos/${videoId}/url`);

    const youtubeId = response?.url_video
      ? getYoutubeIdFromUrl(response.url_video)
      : null;

    if (youtubeId) {
      setPlayError(null);
      setPlaying({
        videoId,
        youtubeId,
        title,
        startAt: response?.watched_seconds ?? 0,
      });
    } else {
      setPlayError("Impossible de lancer la vidéo. Réessayez plus tard.");
    }
  }

  function close() {
    setPlaying(null);
  }

  async function saveProgress(seconds: number): Promise<void> {
    if (!playing || !user) {
      return;
    }

    await fetchAPIWithStatus(`my-progress/${playing.videoId}`, "PUT", {
      watched_seconds: Math.floor(seconds),
    });

    onSaved?.();
  }

  return { playing, play, close, playError, saveProgress };
}
