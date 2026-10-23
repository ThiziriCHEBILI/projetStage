import { useEffect, useState } from "react";
import { useAuth } from "../context/AuthContext";
import { useNavigate } from "react-router";
import { fetchAPI } from "./fetchApi";
import { toEmbedUrl } from "./convert";

export function useVideoPlayer() {
  const [playing, setPlaying] = useState<{ url: string; title: string } | null>(
    null,
  );
  const [playError, setPlayError] = useState<string | null>(null);
  const { token } = useAuth();
  const navigate = useNavigate();
  
  useEffect(() => {
    if (!playError) {
      return;
    }

    const timer = setTimeout(() => setPlayError(null), 4000);

    return () => clearTimeout(timer);
  }, [playError]);

  async function play(videoId: number, title: string): Promise<void> {
    if (!token) {
      navigate("/login");
      return;
    }

    const response = await fetchAPI<{ url_video?: string }>(
      `videos/${videoId}/url`,
      "GET",
      undefined,
      token,
    );

    if (response?.url_video) {
      setPlayError(null);
      setPlaying({ url: toEmbedUrl(response.url_video), title });
    } else {
      setPlayError("Impossible de lancer la vidéo. Réessayez plus tard.");
    }
  }

  function close() {
    setPlaying(null);
  }
  return { playing, play, close, playError };
}
