
import {
  ActivityIndicator,
  Pressable,
  ScrollView,
  StyleSheet,
  Text,
  View,
} from 'react-native';

import { useRouter } from 'expo-router';

import { useAuth } from '../context/AuthContext';

export default function ProfileScreen() {
  const router = useRouter();

  const {
    user,
    token,
    isLoading,
    logout,
  } = useAuth();

  if (isLoading) {
    return (
      <View style={styles.center}>
        <ActivityIndicator size="large" />

        <Text style={styles.loadingText}>
          Restoring session...
        </Text>
      </View>
    );
  }

  if (!user || !token) {
    return (
      <View style={styles.center}>
        <Text style={styles.title}>
          Unauthorized
        </Text>

        <Text style={styles.message}>
          Your session is no longer valid.
        </Text>

        <Pressable
          style={styles.button}
          onPress={() => router.replace('/login')}
        >
          <Text style={styles.buttonText}>
            Go to Login
          </Text>
        </Pressable>
      </View>
    );
  }

  async function handleLogout() {
    await logout();

    router.replace('/login');
  }

  return (
    <ScrollView
      contentContainerStyle={styles.container}
    >
      <Text style={styles.header}>
        Student Profile
      </Text>

      <View style={styles.card}>
        <Text style={styles.name}>
          {user.name}
        </Text>

        <Text style={styles.role}>
          {user.role.toUpperCase()}
        </Text>

        <View style={styles.infoRow}>
          <Text style={styles.label}>
            Student ID
          </Text>

          <Text style={styles.value}>
            {user.studentId}
          </Text>
        </View>

        <View style={styles.infoRow}>
          <Text style={styles.label}>
            Email
          </Text>

          <Text style={styles.value}>
            {user.email}
          </Text>
        </View>

        <View style={styles.infoRow}>
          <Text style={styles.label}>
            Year Level
          </Text>

          <Text style={styles.value}>
            {user.yearLevel}
          </Text>
        </View>
      </View>

      {user.role === 'admin' && (
        <View style={styles.adminBox}>
          <Text style={styles.adminTitle}>
            Admin Area
          </Text>

          <Text style={styles.adminText}>
            Role-aware interface enabled.
          </Text>
        </View>
      )}

      <View style={styles.sessionBox}>
        <Text style={styles.sessionTitle}>
          Protected Session
        </Text>

        <Text style={styles.sessionText}>
          ✓ Token stored securely
        </Text>

        <Text style={styles.sessionText}>
          ✓ Protected profile loaded
        </Text>

        <Text style={styles.sessionText}>
          ✓ Authenticated user detected
        </Text>
      </View>

      <Pressable
        style={styles.logoutButton}
        onPress={handleLogout}
      >
        <Text style={styles.logoutText}>
          Logout
        </Text>
      </Pressable>
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: {
    flexGrow: 1,
    backgroundColor: '#F1F5F9',
    padding: 24,
  },

  center: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    padding: 24,
    backgroundColor: '#F1F5F9',
  },

  loadingText: {
    marginTop: 12,
    fontSize: 16,
    color: '#64748B',
  },

  header: {
    fontSize: 30,
    fontWeight: '700',
    color: '#0F3D68',
    marginBottom: 20,
  },

  card: {
    backgroundColor: '#FFFFFF',
    borderRadius: 20,
    padding: 24,
    elevation: 4,
  },

  name: {
    fontSize: 24,
    fontWeight: '700',
    color: '#0F172A',
  },

  role: {
    marginTop: 6,
    marginBottom: 22,
    color: '#1976B9',
    fontWeight: '700',
    fontSize: 13,
  },

  infoRow: {
    paddingVertical: 14,
    borderTopWidth: 1,
    borderTopColor: '#E2E8F0',
  },

  label: {
    fontSize: 13,
    color: '#64748B',
    marginBottom: 4,
  },

  value: {
    fontSize: 16,
    color: '#0F172A',
    fontWeight: '600',
  },

  adminBox: {
    marginTop: 18,
    padding: 18,
    borderRadius: 16,
    backgroundColor: '#ECFDF5',
  },

  adminTitle: {
    fontSize: 17,
    fontWeight: '700',
    color: '#047857',
  },

  adminText: {
    marginTop: 5,
    color: '#065F46',
  },

  sessionBox: {
    marginTop: 18,
    padding: 18,
    borderRadius: 16,
    backgroundColor: '#EFF6FF',
  },

  sessionTitle: {
    fontSize: 17,
    fontWeight: '700',
    color: '#1E40AF',
    marginBottom: 8,
  },

  sessionText: {
    color: '#1E3A8A',
    marginTop: 4,
  },

  logoutButton: {
    marginTop: 24,
    height: 56,
    borderRadius: 14,
    backgroundColor: '#DC2626',
    justifyContent: 'center',
    alignItems: 'center',
  },

  logoutText: {
    color: '#FFFFFF',
    fontSize: 17,
    fontWeight: '700',
  },

  title: {
    fontSize: 28,
    fontWeight: '700',
    color: '#0F172A',
  },

  message: {
    marginTop: 8,
    color: '#64748B',
    marginBottom: 20,
  },

  button: {
    backgroundColor: '#1976B9',
    paddingHorizontal: 24,
    paddingVertical: 14,
    borderRadius: 12,
  },

  buttonText: {
    color: '#FFFFFF',
    fontWeight: '700',
  },
});