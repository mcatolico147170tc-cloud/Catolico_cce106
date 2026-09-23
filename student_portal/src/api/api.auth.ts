import { StoredUser } from './secureStorage';

const BASE_URL = 'https://dummyjson.com';

export const DEMO_CREDENTIALS = {
  username: 'emilys',
  password: 'emilyspass',
};

export class AuthApiError extends Error {
  status?: number;
  constructor(message: string, status?: number) {
    super(message);
    this.status = status;
  }
}

export async function login(
  username: string,
  password: string
): Promise<{ token: string; user: StoredUser }> {
  const response = await fetch(`${BASE_URL}/auth/login`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ username, password, expiresInMins: 30 }),
  });

  if (response.status === 400 || response.status === 401) {
    throw new AuthApiError('Incorrect username or password.', response.status);
  }

  if (!response.ok) {
    throw new AuthApiError('Login failed. Please try again.', response.status);
  }

  const data = await response.json();

  return {
    token: data.accessToken || data.token,
    user: {
      id: data.id,
      username: data.username,
      firstName: data.firstName,
      lastName: data.lastName,
      email: data.email,
      image: data.image,
      role: data.role || 'student',
    },
  };
}

export async function fetchProfile(token: string) {
  const response = await fetch(`${BASE_URL}/auth/me`, {
    headers: { Authorization: `Bearer ${token}` },
  });

  if (response.status === 401 || response.status === 403) {
    throw new AuthApiError('Session expired. Please log in again.', response.status);
  }

  if (!response.ok) {
    throw new AuthApiError('Could not load your profile.', response.status);
  }

  return response.json();
}