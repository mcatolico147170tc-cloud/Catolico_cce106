
import {
  ActivityIndicator,
  StyleSheet,
  Text,
  View,
} from 'react-native';

import { Redirect } from 'expo-router';

import { useAuth } from '../context/AuthContext';

export default function Index() {
  const {
    isLoading,
    isAuthenticated,
  } = useAuth();

  if (isLoading) {
    return (
      <View style={styles.container}>
        <ActivityIndicator size="large" />

        <Text style={styles.text}>
          Restoring session...
        </Text>
      </View>
    );
  }

  if (isAuthenticated) {
    return <Redirect href="/profile" />;
  }

  return <Redirect href="/login" />;
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#F1F5F9',
  },

  text: {
    marginTop: 12,
    fontSize: 16,
    color: '#64748B',
  },
});