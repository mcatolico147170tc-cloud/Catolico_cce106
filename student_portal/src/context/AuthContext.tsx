import React, { createContext, useContext, useState, useEffect, useCallback } from 'react';
import { saveSession, loadSession, clearSession, StoredUser } from '../api/secureStorage';

type AuthContextValue = {
  isRestoring: boolean;
  token: string | null;
  user: StoredUser | null;
  signIn: (token: string, user: StoredUser) => Promise<void>;
  signOut: () => Promise<void>;
};

const AuthContext = createContext<AuthContextValue | undefined>(undefined);

export function AuthProvider({ children }: { children: React.ReactNode }) {
  const [isRestoring, setIsRestoring] = useState(true);
  const [token, setToken] = useState<string | null>(null);
  const [user, setUser] = useState<StoredUser | null>(null);

  useEffect(() => {
    (async () => {
      const restored = await loadSession();
      if (restored) {
        setToken(restored.token);
        setUser(restored.user);
      }
      setIsRestoring(false);
    })();
  }, []);

  const signIn = useCallback(async (newToken: string, newUser: StoredUser) => {
    await saveSession(newToken, newUser);
    setToken(newToken);
    setUser(newUser);
  }, []);

  const signOut = useCallback(async () => {
    await clearSession();
    setToken(null);
    setUser(null);
  }, []);

  return (
    <AuthContext.Provider value={{ isRestoring, token, user, signIn, signOut }}>
      {children}
    </AuthContext.Provider>
  );
}

export function useAuth() {
  const ctx = useContext(AuthContext);
  if (!ctx) throw new Error('useAuth must be used inside AuthProvider');
  return ctx;
}