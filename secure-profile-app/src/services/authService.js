const BASE_URL = 'https://dummyjson.com';

/**
 * Logs a user in against the DummyJSON practice API.
 * @param {string} username
 * @param {string} password
 * @returns {Promise<object>} the parsed user + token payload
 * @throws {Error} when the credentials are rejected or the request fails
 */
export async function loginUser(username, password) {
  const response = await fetch(`${BASE_URL}/auth/login`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      username,
      password,
      expiresInMins: 30,
    }),
  });

  // TODO 1: If response.ok is false, throw a clear Error.
  if (!response.ok) {
    // Don't leak raw server/network details to the UI; keep it generic.
    throw new Error('Login failed. Check your username and password.');
  }

  // TODO 2: Convert the response body to JSON.
  const data = await response.json();

  // TODO 3: Return the resulting user and token data.
  return data; // contains accessToken plus profile fields (id, username, email, firstName, lastName, image, ...)
}

/**
 * Fetches the currently authenticated user's profile using a Bearer token.
 * @param {string} token
 * @returns {Promise<object>} the parsed user profile
 * @throws {Error} when the token is invalid/expired or the request fails
 */
export async function getCurrentUser(token) {
  const response = await fetch(`${BASE_URL}/auth/me`, {
    method: 'GET',
    headers: {
      // TODO 1: Add the Bearer token to the Authorization header.
      Authorization: `Bearer ${token}`,
    },
  });

  // TODO 2: Throw an Error when the response is not successful.
  if (!response.ok) {
    throw new Error('Session expired. Please log in again.');
  }

  // TODO 3: Return the parsed JSON profile.
  const profile = await response.json();
  return profile;
}
