import { useEffect, useState } from "react";
import type { JSX, ReactNode } from "react";
import { fetchAPI } from "../utilities/fetchApi";
import type { User } from "../Types";
import { AuthContext } from "./AuthContext";

interface AuthProviderProps {
  children: ReactNode;
}

async function getCurrentUser(): Promise<User | null> {
  const response = await fetchAPI<User | { message: string }>("user/me");
  return response && "id" in response ? response : null;
}

export function AuthProvider({ children }: AuthProviderProps): JSX.Element {
  const [token, setToken] = useState<string | undefined>(undefined);
  const [user, setUser] = useState<User | null>(null);
  const [loadingUser, setLoadingUser] = useState(true);

  async function refreshUser(): Promise<void> {
    setUser(await getCurrentUser());
  }

  async function logout(): Promise<void> {
    await fetchAPI("auth/logout", "POST");
    setUser(null);
    setToken(undefined);
  }

  useEffect(() => {
    getCurrentUser().then((currentUser) => {
      setUser(currentUser);
      setLoadingUser(false);
    });
  }, []);

  return (
    <AuthContext.Provider
      value={{ token, user, loadingUser, setToken, refreshUser, logout }}
    >
      {children}
    </AuthContext.Provider>
  );
}
