import { useEffect, useState } from "react";
import { useAuth } from "../context/useAuth";
import { fetchAPIWithStatus } from "./fetchApi";
import type { UserProgress } from "../Types";

export function useProgress() {
  const [progressList, setProgressList] = useState<UserProgress[]>([]);
  const { user } = useAuth();

  useEffect(() => {
    if (!user) {
      return;
    }

    fetchAPIWithStatus<UserProgress[]>("my-progress").then((result) => {
      if (result.ok && result.data) {
        setProgressList(result.data);
      }
    });
  }, [user]);

  async function removeProgress(videoId: number): Promise<void> {
    if (!user) {
      return;
    }

    const result = await fetchAPIWithStatus(`my-progress/${videoId}`, "DELETE");

    if (result.status === 200 || result.status === 404) {
      setProgressList((current) =>
        current.filter((progress) => progress.show_video.id !== videoId),
      );
    }
  }

  return { progressList: user ? progressList : [], removeProgress };
}
