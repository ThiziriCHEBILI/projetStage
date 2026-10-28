import { useEffect, useState } from "react";
import { useAuth } from "../context/useAuth";
import { useNavigate, useLocation } from "react-router";
import { fetchAPI, fetchAPIWithStatus } from "./fetchApi";
import { toVideoId, loginUrl } from "./convert";

export function useVideoPlayer() {
  const [playing, setPlaying] = useState<{
    videoId: number;
    youtubeId: string;
    title: string;
    startAt: number;
  } | null>(null);
  const [playError, setPlayError] = useState<string | null>(null);
  const { token } = useAuth();
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
    if (!token) {
      navigate(loginUrl(location.pathname));
      return;
    }

    const response = await fetchAPI<{
      url_video?: string;
      watched_seconds?: number;
    }>(`videos/${videoId}/url`, "GET", undefined, token);

    if (response?.url_video) {
      setPlayError(null);
      setPlaying({
        videoId,
        youtubeId: toVideoId(response.url_video) ?? "",
        title,
        startAt: response.watched_seconds ?? 0,
      });
    } else {
      setPlayError("Impossible de lancer la vidéo. Réessayez plus tard.");
    }
  }

  function close() {
    setPlaying(null);
  }

  function saveProgress(seconds: number): void {
    if (!playing || !token) {
      return;
    }

    fetchAPIWithStatus(
      `my-progress/${playing.videoId}`,
      "PUT",
      { watched_seconds: Math.floor(seconds) },
      token,
    );
  }

  return { playing, play, close, playError, saveProgress };
}
