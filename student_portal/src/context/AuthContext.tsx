import React, {
  createContext,
  useContext,
  useEffect,
  useState,
} from 'react';

import {
  getProfile,
  loginRequest,
} from '../api/api.auth';

import type { UserProfile } from '../api/api.auth';

import {
  getToken,
  removeToken,
  saveToken,
} from '../api/secureStorage';

type AuthContextType = {
  user: UserProfile | null;
  token: string | null;
  isLoading: boolean;
  isAuthenticated: boolean;
  login: (email: string, password: string) => Promise<void>;
  logout: () => Promise<void>;
};

const AuthContext = createContext<AuthContextType | undefined>(
  undefined
);

export function AuthProvider({
  children,
}: {
  children: React.ReactNode;
}) {
  const [user, setUser] = useState<UserProfile | null>(null);
  const [token, setToken] = useState<string | null>(null);
  const [isLoading, setIsLoading] = useState(true);

  /*
   * Restore the previous session when the app starts.
   */
  useEffect(() => {
    restoreSession();
  }, []);

  /*
   * Restore token and protected profile.
   */
  async function restoreSession(): Promise<void> {
    try {
      const storedToken = await getToken();

      if (!storedToken) {
        setToken(null);
        setUser(null);
        return;
      }

      const profile = await getProfile(storedToken);

      setToken(storedToken);
      setUser(profile);
    } catch (error) {
      console.log('Session restore failed:', error);

      await removeToken();

      setToken(null);
      setUser(null);
    } finally {
      setIsLoading(false);
    }
  }

  /*
   * Login:
   * credentials → token → secure storage → user
   */
  async function login(
    email: string,
    password: string
  ): Promise<void> {
    const response = await loginRequest(
      email,
      password
    );

    if (!response.token) {
      throw new Error(
        'Login succeeded but no authentication token was returned.'
      );
    }

    await saveToken(response.token);

    setToken(response.token);
    setUser(response.user);
  }

  /*
   * Logout:
   * remove token → clear authentication state
   */
  async function logout(): Promise<void> {
    await removeToken();

    setToken(null);
    setUser(null);
  }

  const isAuthenticated =
    token !== null && user !== null;

  return (
    <AuthContext.Provider
      value={{
        user,
        token,
        isLoading,
        isAuthenticated,
        login,
        logout,
      }}
    >
      {children}
    </AuthContext.Provider>
  );
}

export function useAuth(): AuthContextType {
  const context = useContext(AuthContext);

  if (context === undefined) {
    throw new Error(
      'useAuth must be used inside AuthProvider'
    );
  }

  return context;
}