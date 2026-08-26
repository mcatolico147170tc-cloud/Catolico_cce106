
import { router } from 'expo-router';
import React from 'react';
import {
    Pressable,
    ScrollView,
    StyleSheet,
    Text,
    View,
    useColorScheme,
} from 'react-native';

export default function ModalScreen() {
  const colorScheme = useColorScheme();
  const isDark = colorScheme === 'dark';

  const colors = {
    background: isDark ? '#121212' : '#F5F7FA',
    card: isDark ? '#1E1E1E' : '#FFFFFF',
    text: isDark ? '#FFFFFF' : '#172033',
    secondary: isDark ? '#B8B8B8' : '#667085',
    blue: '#1976D2',
    border: isDark ? '#303030' : '#E5E7EB',
  };

  return (
    <ScrollView
      style={[styles.container, { backgroundColor: colors.background }]}
      contentContainerStyle={styles.content}
    >
      {/* Header */}
      <View style={[styles.header, { backgroundColor: colors.blue }]}>
        <Text style={styles.headerTitle}>ABOUT MY APP</Text>
        <Text style={styles.headerSubtitle}>
          Application Development
        </Text>
      </View>

      {/* Main Card */}
      <View
        style={[
          styles.card,
          {
            backgroundColor: colors.card,
            borderColor: colors.border,
          },
        ]}
      >
        <View style={styles.iconCircle}>
          <Text style={styles.icon}>💻</Text>
        </View>

        <Text style={[styles.title, { color: colors.text }]}>
          Student Profile
        </Text>

        <Text style={[styles.description, { color: colors.secondary }]}>
          This application is a simple student profile app created as part
          of my Application Development and Emerging Technologies subject.
        </Text>
      </View>

      {/* Purpose */}
      <View
        style={[
          styles.card,
          {
            backgroundColor: colors.card,
            borderColor: colors.border,
          },
        ]}
      >
        <Text style={[styles.cardTitle, { color: colors.text }]}>
          🎯 Purpose of the App
        </Text>

        <Text style={[styles.description, { color: colors.secondary }]}>
          The purpose of this application is to present my personal
          information, interests, coding experience, and career goal in
          a simple and organized mobile application.
        </Text>
      </View>

      {/* What I Want To Learn */}
      <View
        style={[
          styles.card,
          {
            backgroundColor: colors.card,
            borderColor: colors.border,
          },
        ]}
      >
        <Text style={[styles.cardTitle, { color: colors.text }]}>
          🚀 What I Want To Learn
        </Text>

        <Text style={[styles.description, { color: colors.secondary }]}>
          I want to learn how to build applications, understand emerging
          technologies, improve my programming skills, and gain more
          experience in developing useful applications.
        </Text>
      </View>

      {/* Developer */}
      <View
        style={[
          styles.card,
          {
            backgroundColor: colors.card,
            borderColor: colors.border,
          },
        ]}
      >
        <Text style={[styles.cardTitle, { color: colors.text }]}>
          👨‍💻 Developer
        </Text>

        <Text style={[styles.name, { color: colors.text }]}>
          Mark Joseph P. Catolico
        </Text>

        <Text style={[styles.course, { color: colors.secondary }]}>
          BSIT • 3rd Year
        </Text>

        <Text style={[styles.course, { color: colors.secondary }]}>
          Future Network Engineer
        </Text>
      </View>

      {/* Close Button */}
      <Pressable
        style={styles.closeButton}
        onPress={() => router.back()}
      >
        <Text style={styles.closeText}>Close</Text>
      </Pressable>
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
  },

  content: {
    paddingBottom: 30,
  },

  header: {
    paddingTop: 55,
    paddingBottom: 28,
    paddingHorizontal: 22,
  },

  headerTitle: {
    color: '#FFFFFF',
    fontSize: 13,
    fontWeight: '800',
    letterSpacing: 1.5,
  },

  headerSubtitle: {
    color: '#FFFFFF',
    fontSize: 25,
    fontWeight: '800',
    marginTop: 8,
  },

  card: {
    marginHorizontal: 18,
    marginTop: 16,
    padding: 20,
    borderRadius: 16,
    borderWidth: 1,
  },

  iconCircle: {
    width: 70,
    height: 70,
    borderRadius: 35,
    backgroundColor: '#E8F2FC',
    justifyContent: 'center',
    alignItems: 'center',
    alignSelf: 'center',
    marginBottom: 15,
  },

  icon: {
    fontSize: 32,
  },

  title: {
    fontSize: 22,
    fontWeight: '800',
    textAlign: 'center',
  },

  description: {
    fontSize: 14,
    lineHeight: 22,
    marginTop: 10,
  },

  cardTitle: {
    fontSize: 18,
    fontWeight: '800',
    marginBottom: 8,
  },

  name: {
    fontSize: 17,
    fontWeight: '700',
  },

  course: {
    fontSize: 14,
    marginTop: 5,
  },

  closeButton: {
    marginHorizontal: 18,
    marginTop: 20,
    backgroundColor: '#1976D2',
    paddingVertical: 14,
    borderRadius: 12,
    alignItems: 'center',
  },

  closeText: {
    color: '#FFFFFF',
    fontSize: 16,
    fontWeight: '700',
  },
});

