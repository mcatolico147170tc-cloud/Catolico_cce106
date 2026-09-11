import { useState } from 'react';
import {
    SafeAreaView,
    StyleSheet,
    Switch,
    Text,
    View,
} from 'react-native';

export default function SettingsScreen() {
  const [notifications, setNotifications] = useState(true);

  return (
    <SafeAreaView style={styles.safeArea}>
      <View style={styles.container}>
        <Text style={styles.title}>Settings</Text>

        <View style={styles.card}>
          <View style={styles.row}>
            <View>
              <Text style={styles.settingTitle}>
                Notifications
              </Text>

              <Text style={styles.settingDescription}>
                Receive student and course updates
              </Text>
            </View>

            <Switch
              value={notifications}
              onValueChange={setNotifications}
            />
          </View>
        </View>

        <View style={styles.card}>
          <Text style={styles.settingTitle}>
            Account Information
          </Text>

          <Text style={styles.settingDescription}>
            Mark Joseph P. Catolico
          </Text>

          <Text style={styles.settingDescription}>
            Student ID: 147170
          </Text>

          <Text style={styles.settingDescription}>
            3rd Year
          </Text>
        </View>
      </View>
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  safeArea: {
    flex: 1,
    backgroundColor: '#F8FAFC',
  },

  container: {
    flex: 1,
    padding: 20,
  },

  title: {
    fontSize: 28,
    fontWeight: '800',
    color: '#0F172A',
    marginBottom: 20,
  },

  card: {
    backgroundColor: '#FFFFFF',
    borderRadius: 15,
    padding: 20,
    marginBottom: 15,
    borderWidth: 1,
    borderColor: '#E2E8F0',
  },

  row: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
  },

  settingTitle: {
    fontSize: 16,
    fontWeight: '700',
    color: '#0F172A',
  },

  settingDescription: {
    fontSize: 13,
    color: '#64748B',
    marginTop: 5,
  },
});