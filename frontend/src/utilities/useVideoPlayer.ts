import { useEffect, useState } from "react";
import { useAuth } from "../context/AuthContext";
import { useNavigate, useLocation } from "react-router";
import { fetchAPI } from "./fetchApi";
import { toEmbedUrl, loginUrl } from "./convert";

export function useVideoPlayer() {
  const [playing, setPlaying] = useState<{
    url: string;
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
        url: toEmbedUrl(response.url_video),
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
  return { playing, play, close, playError };
}
