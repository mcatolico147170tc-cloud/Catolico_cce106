import React, { useEffect, useState } from 'react';
import {
    ActivityIndicator,
    Alert,
    Image,
    KeyboardAvoidingView,
    Platform,
    SafeAreaView,
    StyleSheet,
    Text,
    TextInput,
    TouchableOpacity,
    View,
} from 'react-native';

import { getCurrentUser, loginUser } from './src/services/authService';
import { deleteToken, getToken, saveToken } from './src/storage/tokenStorage';

export default function App() {
  // ---- State ----
  const [username, setUsername] = useState('emilys');
  const [password, setPassword] = useState('emilyspass');
  const [showPassword, setShowPassword] = useState(false); // optional extension: show/hide password
  const [profile, setProfile] = useState(null);
  const [loading, setLoading] = useState(true); // true on first mount while we check for a stored session
  const [submitting, setSubmitting] = useState(false); // true only while the login request is in flight
  const [error, setError] = useState('');

  // ---- Restore session on app start ----
  useEffect(() => {
    async function restoreSession() {
      try {
        const storedToken = await getToken();
        if (!storedToken) {
          setLoading(false);
          return;
        }
        const user = await getCurrentUser(storedToken);
        setProfile(user);
      } catch (err) {
        // Stored token is invalid, expired, or the request failed. Clean it up.
        await deleteToken();
        setProfile(null);
      } finally {
        setLoading(false);
      }
    }
    restoreSession();
  }, []);

  // ---- Login flow ----
  async function handleLogin() {
    setError('');
    setSubmitting(true);
    try {
      const data = await loginUser(username.trim(), password);
      await saveToken(data.accessToken);

      // We already have the profile fields from the login response,
      // but re-fetching via the protected endpoint proves the Bearer flow works end-to-end.
      const user = await getCurrentUser(data.accessToken);
      setProfile(user);
    } catch (err) {
      setError('Login failed. Check your username and password.');
    } finally {
      setSubmitting(false);
    }
  }


  async function performLogout() {
    await deleteToken();
    setProfile(null);
    setError('');
  }

  function handleLogout() {
   
    Alert.alert('Log out', 'Are you sure you want to log out?', [
      { text: 'Cancel', style: 'cancel' },
      { text: 'Log out', style: 'destructive', onPress: performLogout },
    ]);
  }

  if (loading) {
    return (
      <SafeAreaView style={styles.centered}>
        <ActivityIndicator size="large" />
        <Text style={styles.loadingText}>Checking session…</Text>
      </SafeAreaView>
    );
  }

  if (!profile) {
    return (
      <SafeAreaView style={styles.container}>
        <KeyboardAvoidingView
          behavior={Platform.OS === 'ios' ? 'padding' : undefined}
          style={styles.flex}
        >
          <View style={styles.formWrap}>
            <Text style={styles.heading}>Secure Profile</Text>
            <Text style={styles.subheading}>Sign in to continue</Text>

            <Text style={styles.label}>Username</Text>
            <TextInput
              style={styles.input}
              value={username}
              onChangeText={setUsername}
              autoCapitalize="none"
              autoCorrect={false}
              placeholder="Username"
            />

            <Text style={styles.label}>Password</Text>
            <View style={styles.passwordRow}>
              <TextInput
                style={styles.passwordInput}
                value={password}
                onChangeText={setPassword}
                secureTextEntry={!showPassword}
                autoCapitalize="none"
                autoCorrect={false}
                placeholder="Password"
              />
              <TouchableOpacity onPress={() => setShowPassword((v) => !v)}>
                <Text style={styles.toggleText}>{showPassword ? 'Hide' : 'Show'}</Text>
              </TouchableOpacity>
            </View>

            {!!error && <Text style={styles.error}>{error}</Text>}

            <TouchableOpacity
              style={[styles.button, submitting && styles.buttonDisabled]}
              onPress={handleLogin}
              disabled={submitting}
            >
              {submitting ? (
                <ActivityIndicator color="#fff" />
              ) : (
                <Text style={styles.buttonText}>Login</Text>
              )}
            </TouchableOpacity>

            {submitting && <Text style={styles.loadingText}>Signing in…</Text>}
          </View>
        </KeyboardAvoidingView>
      </SafeAreaView>
    );
  }

 
  return (
    <SafeAreaView style={styles.container}>
      <View style={styles.profileWrap}>
        {!!profile.image && (
          <Image source={{ uri: profile.image }} style={styles.avatar} />
        )}
        <Text style={styles.heading}>
          {profile.firstName} {profile.lastName}
        </Text>
        <View style={styles.card}>
          <ProfileRow label="Username" value={profile.username} />
          <ProfileRow label="Email" value={profile.email} />
          <ProfileRow label="User ID" value={String(profile.id)} />
        </View>

        <TouchableOpacity style={[styles.button, styles.logoutButton]} onPress={handleLogout}>
          <Text style={styles.buttonText}>Logout</Text>
        </TouchableOpacity>
      </View>
    </SafeAreaView>
  );
}

function ProfileRow({ label, value }) {
  return (
    <View style={styles.row}>
      <Text style={styles.rowLabel}>{label}</Text>
      <Text style={styles.rowValue}>{value}</Text>
    </View>
  );
}

const styles = StyleSheet.create({
  flex: { flex: 1 },
  container: { flex: 1, backgroundColor: '#0f172a' },
  centered: {
    flex: 1,
    backgroundColor: '#0f172a',
    alignItems: 'center',
    justifyContent: 'center',
  },
  formWrap: { flex: 1, justifyContent: 'center', paddingHorizontal: 24 },
  profileWrap: { flex: 1, justifyContent: 'center', paddingHorizontal: 24 },
  heading: { fontSize: 26, fontWeight: '700', color: '#fff', marginBottom: 4, textAlign: 'center' },
  subheading: { fontSize: 14, color: '#94a3b8', marginBottom: 24, textAlign: 'center' },
  label: { color: '#cbd5e1', marginBottom: 6, marginTop: 12, fontSize: 13 },
  input: {
    backgroundColor: '#1e293b',
    color: '#fff',
    borderRadius: 8,
    paddingHorizontal: 14,
    paddingVertical: 12,
    fontSize: 15,
  },
  passwordRow: {
    flexDirection: 'row',
    alignItems: 'center',
    backgroundColor: '#1e293b',
    borderRadius: 8,
    paddingRight: 14,
  },
  passwordInput: {
    flex: 1,
    color: '#fff',
    paddingHorizontal: 14,
    paddingVertical: 12,
    fontSize: 15,
  },
  toggleText: { color: '#60a5fa', fontSize: 13, fontWeight: '600' },
  error: {
    color: '#f87171',
    marginTop: 14,
    fontSize: 14,
    textAlign: 'center',
  },
  button: {
    backgroundColor: '#2563eb',
    borderRadius: 8,
    paddingVertical: 14,
    alignItems: 'center',
    marginTop: 20,
  },
  buttonDisabled: { opacity: 0.6 },
  buttonText: { color: '#fff', fontSize: 16, fontWeight: '600' },
  loadingText: { color: '#94a3b8', marginTop: 10, textAlign: 'center' },
  avatar: {
    width: 96,
    height: 96,
    borderRadius: 48,
    alignSelf: 'center',
    marginBottom: 16,
  },
  card: {
    backgroundColor: '#1e293b',
    borderRadius: 10,
    padding: 16,
    marginTop: 20,
  },
  row: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    paddingVertical: 8,
    borderBottomWidth: StyleSheet.hairlineWidth,
    borderBottomColor: '#334155',
  },
  rowLabel: { color: '#94a3b8', fontSize: 14 },
  rowValue: { color: '#fff', fontSize: 14, fontWeight: '500', maxWidth: '65%', textAlign: 'right' },
  logoutButton: { backgroundColor: '#dc2626' },
});
