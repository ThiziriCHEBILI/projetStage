import { createContext } from "react";
import type { User } from "../Types";

export interface AuthContextType {
  token: string | undefined;
  user: User | null;
  loadingUser: boolean;
  setToken: (token: string | undefined) => void;
  refreshUser: () => Promise<void>;
  logout: () => Promise<void>;
}

export const AuthContext = createContext<AuthContextType>({
  token: undefined,
  user: null,
  loadingUser: false,
  setToken: () => {},
  refreshUser: async () => {},
  logout: async () => {},
});
