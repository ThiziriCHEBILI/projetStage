import { useEffect, useState } from "react";
import { useAuth } from "../context/AuthProvider";
import { fetchAPIWithStatus } from "./fetchApi";
import type { Show } from "../Types";
import { useLocation, useNavigate } from "react-router";
import { loginUrl } from "./convert";

export function useMyList() {
  const [myList, setMyList] = useState<Show[]>([]);
  const [loaded, setLoaded] = useState(false);
  const [listError, setListError] = useState<string | null>(null);
  const { token } = useAuth();
  const navigate = useNavigate();
  const location = useLocation();

  useEffect(() => {
    if (!token) {
      return;
    }

    fetchAPIWithStatus<Show[]>("my-list", "GET", undefined, token).then(
      (result) => {
        if (result.ok && result.data) {
          setMyList(result.data);
        } else {
          setListError("Impossible de charger votre liste.");
        }
        setLoaded(true);
      },
    );
  }, [token]);

  useEffect(() => {
    if (!listError) {
      return;
    }

    const timer = setTimeout(() => setListError(null), 4000);

    return () => clearTimeout(timer);
  }, [listError]);

  const listLoading = Boolean(token) && !loaded;

  function isInList(showId: number): boolean {
    return myList.some((show) => show.id === showId);
  }

  async function addToMyList(show: Show): Promise<void> {
    if (!token) {
      navigate(loginUrl(location.pathname));
      return;
    }

    const result = await fetchAPIWithStatus(
      `my-list/${show.id}`,
      "POST",
      undefined,
      token,
    );

    if (result.status === 201 || result.status === 409) {
      setListError(null);
      setMyList((current) =>
        current.some((item) => item.id === show.id)
          ? current
          : [show, ...current],
      );
    } else {
      setListError("Impossible d'ajouter ce show à votre liste.");
    }
  }

  async function removeFromMyList(showId: number): Promise<void> {
    if (!token) {
      navigate(loginUrl(location.pathname));
      return;
    }

    const result = await fetchAPIWithStatus(
      `my-list/${showId}`,
      "DELETE",
      undefined,
      token,
    );

    if (result.status === 200 || result.status === 404) {
      setListError(null);
      setMyList((current) => current.filter((item) => item.id !== showId));
    } else {
      setListError("Impossible de retirer ce show de votre liste.");
    }
  }

  return {
    myList,
    listLoading,
    listError,
    isInList,
    addToMyList,
    removeFromMyList,
  };
}
