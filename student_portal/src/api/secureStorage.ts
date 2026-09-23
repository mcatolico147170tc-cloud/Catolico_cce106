import * as SecureStore from 'expo-secure-store';

const TOKEN_KEY = 'student_portal_token';
const USER_KEY = 'student_portal_user';

export type StoredUser = {
  id: number;
  username: string;
  firstName: string;
  lastName: string;
  email: string;
  image?: string;
  role: string;
};

export async function saveSession(token: string, user: StoredUser) {
  await SecureStore.setItemAsync(TOKEN_KEY, token);
  await SecureStore.setItemAsync(USER_KEY, JSON.stringify(user));
}

export async function loadSession(): Promise<{ token: string; user: StoredUser } | null> {
  const token = await SecureStore.getItemAsync(TOKEN_KEY);
  const rawUser = await SecureStore.getItemAsync(USER_KEY);

  if (!token || !rawUser) return null;

  try {
    return { token, user: JSON.parse(rawUser) };
  } catch {
    return null;
  }
}

export async function clearSession() {
  await SecureStore.deleteItemAsync(TOKEN_KEY);
  await SecureStore.deleteItemAsync(USER_KEY);
}