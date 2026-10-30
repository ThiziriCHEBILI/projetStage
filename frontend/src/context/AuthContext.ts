import { createContext } from "react";
import type { User } from "../Types";

export interface AuthContextType {
  user: User | null;
  loadingUser: boolean;
  refreshUser: () => Promise<void>;
  logout: () => Promise<void>;
}

export const AuthContext = createContext<AuthContextType>({
  user: null,
  loadingUser: false,
  refreshUser: async () => {},
  logout: async () => {},
});
