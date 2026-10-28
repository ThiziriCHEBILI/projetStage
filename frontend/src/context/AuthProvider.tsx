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

  const [user, setUser] = useState<User | null>(null);
  const [loadingUser, setLoadingUser] = useState(token !== undefined);

  function logout(): void {
    localStorage.removeItem("token");
    sessionStorage.removeItem("token");
    setToken(undefined);
  }

  useEffect(() => {
    if (!token) {
      setUser(null);
      setLoadingUser(false);
      return;
    }

    let ignore = false;
    setLoadingUser(true);

    fetchAPI<User | { message: string }>(
      "user/me",
      "GET",
      undefined,
      token,
    ).then((response) => {
      if (ignore) return;

      if (response && "id" in response) {
        setUser(response);
      } else if (response && "message" in response) {
        logout();
      }

      setLoadingUser(false);
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
