import { createContext, useContext, useEffect, useState } from "react";
import type { JSX, ReactNode } from "react";
import { fetchAPI } from "../utilities/fetchApi";
import type { User } from "../Types";

interface AuthContextType {
  token: string | undefined;
  user: User | null;
  loadingUser: boolean;
  setToken: (token: string | undefined) => void;
  logout: () => void;
}

interface AuthProviderProps {
  children: ReactNode;
}

const AuthContext = createContext<AuthContextType>({
  token: undefined,
  user: null,
  loadingUser: false,
  setToken: () => {},
  logout: () => {},
});

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

export function useAuth() {
  return useContext(AuthContext);
}
