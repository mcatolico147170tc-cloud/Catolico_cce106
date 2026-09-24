import { useEffect, useState } from "react";

import {
  ActivityIndicator,
  Button,
  Image,
  SafeAreaView,
  StyleSheet,
  Text,
  TextInput,
  View,
} from "react-native";

import {
  getCurrentUser,
  loginUser,
} from "../services/authService";

import {
  deleteToken,
  getToken,
  saveToken,
} from "../storage/tokenstorage";

type Profile = {
  id: number;
  username: string;
  email: string;
  firstName: string;
  lastName: string;
  image?: string;
};

type LoginResponse = {
  accessToken: string;
};

export default function HomeScreen() {
  const [username, setUsername] = useState("emilys");
  const [password, setPassword] = useState("emilyspass");

  const [profile, setProfile] = useState<Profile | null>(null);

  const [loading, setLoading] = useState(true);
  const [submitting, setSubmitting] = useState(false);

  const [error, setError] = useState("");

  useEffect(() => {
    restoreSession();
  }, []);

  // Restore saved login session
  async function restoreSession() {
    try {
      const token = await getToken();

      if (!token) {
        setLoading(false);
        return;
      }

      const user = (await getCurrentUser(token)) as Profile;

      setProfile(user);
    } catch (err) {
      await deleteToken();
      setProfile(null);
    } finally {
      setLoading(false);
    }
  }

  // Login
  async function handleLogin() {
    setError("");
    setSubmitting(true);

    try {
      const result = await loginUser(
        username,
        password
      );

      const data = result as LoginResponse;

      if (!data.accessToken) {
        throw new Error("No access token returned");
      }

      await saveToken(data.accessToken);

      const user = (await getCurrentUser(
        data.accessToken
      )) as Profile;

      setProfile(user);
    } catch (err) {
      setError(
        "Login failed. Check your username and password."
      );

      setProfile(null);
    } finally {
      setSubmitting(false);
    }
  }

 
  async function handleLogout() {
    try {
      await deleteToken();
    } finally {
      setProfile(null);
      setError("");
    }
  }

  
  if (loading) {
    return (
      <SafeAreaView style={styles.container}>
        <View style={styles.card}>
          <ActivityIndicator size="large" />

          <Text style={styles.loadingText}>
            Loading...
          </Text>
        </View>
      </SafeAreaView>
    );
  }

  
  if (profile === null) {
    return (
      <SafeAreaView style={styles.container}>
        <View style={styles.card}>
          <Text style={styles.title}>
            Secure Profile
          </Text>

          <Text style={styles.label}>
            Username
          </Text>

          <TextInput
            style={styles.input}
            value={username}
            onChangeText={setUsername}
            autoCapitalize="none"
            autoCorrect={false}
            placeholder="Username"
          />

          <Text style={styles.label}>
            Password
          </Text>

          <TextInput
            style={styles.input}
            value={password}
            onChangeText={setPassword}
            secureTextEntry
            autoCapitalize="none"
            autoCorrect={false}
            placeholder="Password"
          />

          {error !== "" && (
            <Text style={styles.error}>
              {error}
            </Text>
          )}

          {submitting ? (
            <ActivityIndicator size="small" />
          ) : (
            <Button
              title="Login"
              onPress={handleLogin}
            />
          )}
        </View>
      </SafeAreaView>
    );
  }

  
  return (
    <SafeAreaView style={styles.container}>
      <View style={styles.card}>
        <Text style={styles.title}>
          My Profile
        </Text>

        {profile.image ? (
          <Image
            source={{ uri: profile.image }}
            style={styles.image}
          />
        ) : null}

        <Text style={styles.profileText}>
          Name: {profile.firstName} {profile.lastName}
        </Text>

        <Text style={styles.profileText}>
          Username: {profile.username}
        </Text>

        <Text style={styles.profileText}>
          Email: {profile.email}
        </Text>

        <Text style={styles.profileText}>
          ID: {profile.id}
        </Text>

        <View style={styles.logout}>
          <Button
            title="Logout"
            onPress={handleLogout}
          />
        </View>
      </View>
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: "#f2f4f7",
    justifyContent: "center",
    padding: 20,
  },

  card: {
    backgroundColor: "#ffffff",
    padding: 24,
    borderRadius: 12,
    elevation: 3,
  },

  title: {
    fontSize: 28,
    fontWeight: "bold",
    marginBottom: 24,
    textAlign: "center",
  },

  label: {
    fontSize: 16,
    fontWeight: "600",
    marginBottom: 6,
  },

  input: {
    borderWidth: 1,
    borderColor: "#cccccc",
    borderRadius: 8,
    padding: 12,
    marginBottom: 16,
  },

  error: {
    color: "red",
    marginBottom: 16,
    textAlign: "center",
  },

  loadingText: {
    marginTop: 12,
    textAlign: "center",
  },

  image: {
    width: 100,
    height: 100,
    borderRadius: 50,
    alignSelf: "center",
    marginBottom: 20,
  },

  profileText: {
    fontSize: 16,
    marginBottom: 12,
  },

  logout: {
    marginTop: 20,
  },
});