import { useEffect, useState } from "react";
import type { JSX, ReactNode } from "react";
import { fetchAPI } from "../utilities/fetchApi";
import type { User } from "../Types";
import { AuthContext } from "./AuthContext";

interface AuthProviderProps {
  children: ReactNode;
}

export function AuthProvider({ children }: AuthProviderProps): JSX.Element {
  const [token, setToken] = useState<string | undefined>(
    localStorage.getItem("token") ||
      sessionStorage.getItem("token") ||
      undefined,
  );

  const [loadedUser, setLoadedUser] = useState<{
    token: string;
    user: User | null;
  } | null>(null);

  const user = token && loadedUser?.token === token ? loadedUser.user : null;
  const loadingUser = Boolean(token) && loadedUser?.token !== token;
  function logout(): void {
    localStorage.removeItem("token");
    sessionStorage.removeItem("token");
    setToken(undefined);
  }

  useEffect(() => {
    if (!token) {
      return;
    }

    let ignore = false;

    fetchAPI<User | { message: string }>(
      "user/me",
      "GET",
      undefined,
      token,
    ).then((response) => {
      if (ignore) return;

      if (response && "message" in response) {
        logout();
        return;
      }

      setLoadedUser({
        token,
        user: response && "id" in response ? response : null,
      });
    });

    return () => {
      ignore = true;
    };
  }, [token]);

  return (
    <AuthContext.Provider
      value={{ token, user, loadingUser, setToken, logout }}
    >
      {children}
    </AuthContext.Provider>
  );
}
