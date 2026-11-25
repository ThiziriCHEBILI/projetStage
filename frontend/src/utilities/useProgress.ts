import { useEffect, useState } from "react";
import { useAuth } from "../context/useAuth";
import { fetchAPIWithStatus } from "./fetchApi";
import type { UserProgress } from "../Types";

async function getProgressList(): Promise<UserProgress[] | null> {
  const result = await fetchAPIWithStatus<UserProgress[]>("my-progress");
  return result.ok && result.data ? result.data : null;
}

export function useProgress() {
  const [progressList, setProgressList] = useState<UserProgress[]>([]);
  const { user } = useAuth();

  useEffect(() => {
    if (!user) {
      return;
    }

    async function loadProgress(): Promise<void> {
      const list = await getProgressList();
      if (list) {
        setProgressList(list);
      }
    }

    loadProgress();
  }, [user]);

  async function refreshProgress(): Promise<void> {
    const list = await getProgressList();
    if (list) {
      setProgressList(list);
    }
  }

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

  return {
    progressList: user ? progressList : [],
    removeProgress,
    refreshProgress,
  };
}
