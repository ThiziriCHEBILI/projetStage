import { useEffect, useState } from "react";
import { useAuth } from "../context/useAuth";
import { fetchAPIWithStatus } from "./fetchApi";
import type { UserProgress } from "../Types";

export function useProgress() {
  const [progressList, setProgressList] = useState<UserProgress[]>([]);
  const { token } = useAuth();

  useEffect(() => {
    if (!token) {
      return;
    }

    fetchAPIWithStatus<UserProgress[]>(
      "my-progress",
      "GET",
      undefined,
      token,
    ).then((result) => {
      if (result.ok && result.data) {
        setProgressList(result.data);
      }
    });
  }, [token]);

  async function removeProgress(videoId: number): Promise<void> {
    if (!token) {
      return;
    }

    const result = await fetchAPIWithStatus(
      `my-progress/${videoId}`,
      "DELETE",
      undefined,
      token,
    );

    if (result.status === 200 || result.status === 404) {
      setProgressList((current) =>
        current.filter((progress) => progress.show_video.id !== videoId),
      );
    }
  }

  return { progressList: token ? progressList : [], removeProgress };
}
