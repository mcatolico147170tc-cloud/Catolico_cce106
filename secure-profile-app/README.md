# Secure Profile App

Name: ______________________
Section: ______________________

## What this is
An Expo React Native app that logs in to the DummyJSON practice API, stores the
returned access token with `expo-secure-store`, restores the session on reload,
fetches a protected profile using a Bearer token, and clears the session on logout.

## Project structure
```
secure-profile-app/
  App.js
  src/
    services/
      authService.js      # loginUser, getCurrentUser
    storage/
      tokenStorage.js      # saveToken, getToken, deleteToken (expo-secure-store)
```

## Installation
```bash
npx create-expo-app secure-profile-app
cd secure-profile-app
npx expo install expo-secure-store
# then copy App.js and the src/ folder from this submission into the project
```

## Run
```bash
npx expo start
```
Run on an Android or iOS device/emulator (SecureStore is native-only; the web
target is not used for this app).

## Test credentials (DummyJSON public test data)
- Username: `emilys`
- Password: `emilyspass`

## Security notes
- The token is never hard-coded or logged; it is only held in memory and in
  SecureStore.
- The token is sent only via `Authorization: Bearer <token>`.
- Logout calls `deleteToken()` to remove it from SecureStore.
- An invalid/expired token found on startup is deleted automatically and the
  user is returned to the login screen.