
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

export default function HomeScreen() {
  const colorScheme = useColorScheme();
  const isDark = colorScheme === 'dark';

  const colors = {
    background: isDark ? '#121212' : '#F4F7FB',
    card: isDark ? '#1E1E1E' : '#FFFFFF',
    text: isDark ? '#FFFFFF' : '#172033',
    secondary: isDark ? '#BDBDBD' : '#667085',
    blue: '#1976D2',
    lightBlue: isDark ? '#153A5B' : '#E8F2FC',
    border: isDark ? '#303030' : '#E3E7ED',
  };

  return (
    <ScrollView
      style={[styles.container, { backgroundColor: colors.background }]}
      contentContainerStyle={styles.content}
      showsVerticalScrollIndicator={false}
    >
      {/* HEADER */}
      <View style={[styles.header, { backgroundColor: colors.blue }]}>
        <Text style={styles.headerTitle}>STUDENT PROFILE</Text>

        <Text style={styles.greeting}>
          Hello, Mark! 👋
        </Text>

        <Text style={styles.headerSubtitle}>
          Welcome to my personal app
        </Text>
      </View>

      {/* PROFILE */}
      <View
        style={[
          styles.profileCard,
          {
            backgroundColor: colors.card,
            borderColor: colors.border,
          },
        ]}
      >
        <View style={styles.avatar}>
          <Text style={styles.avatarText}>M</Text>
        </View>

        <Text style={[styles.name, { color: colors.text }]}>
          Mark Joseph P. Catolico
        </Text>

        <Text style={[styles.course, { color: colors.secondary }]}>
          Bachelor of Science in Information Technology
        </Text>

        <View
          style={[
            styles.badge,
            { backgroundColor: colors.lightBlue },
          ]}
        >
          <Text style={[styles.badgeText, { color: colors.blue }]}>
            BSIT • 3rd Year
          </Text>
        </View>
      </View>

      {/* ABOUT ME */}
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
          👨‍💻 About Me
        </Text>

        <Text style={[styles.description, { color: colors.secondary }]}>
          Hi! I’m Mark Joseph P. Catolico, a third-year BSIT student
          from Purok 8, San Miguel, Tagum City. I am interested in
          technology, programming, and learning how to create useful
          applications.
        </Text>
      </View>

      {/* PERSONAL INFORMATION */}
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
          📋 Personal Information
        </Text>

        <InfoRow
          label="Name"
          value="Mark Joseph P. Catolico"
          colors={colors}
        />

        <InfoRow
          label="Course"
          value="BSIT"
          colors={colors}
        />

        <InfoRow
          label="Year Level"
          value="3rd Year"
          colors={colors}
        />

        <InfoRow
          label="Address"
          value="Purok 8, San Miguel, Tagum City"
          colors={colors}
          last
        />
      </View>

      {/* HOBBIES */}
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
          🎮 My Hobbies
        </Text>

        <View style={styles.hobbyContainer}>
          <View
            style={[
              styles.hobby,
              { backgroundColor: colors.lightBlue },
            ]}
          >
            <Text style={styles.hobbyEmoji}>🏀</Text>

            <Text style={[styles.hobbyText, { color: colors.text }]}>
              Basketball
            </Text>
          </View>

          <View
            style={[
              styles.hobby,
              { backgroundColor: colors.lightBlue },
            ]}
          >
            <Text style={styles.hobbyEmoji}>🎮</Text>

            <Text style={[styles.hobbyText, { color: colors.text }]}>
              Video Games
            </Text>
          </View>
        </View>
      </View>

      {/* CODING EXPERIENCE */}
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
          💻 Coding Experience
        </Text>

        <Text style={[styles.description, { color: colors.secondary }]}>
          I started experiencing coding during my previous years in
          college. I have worked on different programming activities
          and projects. I am still learning and improving my coding
          skills.
        </Text>
      </View>

      {/* WHAT I WANT TO LEARN */}
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
          In Application Development and Emerging Technologies, I want
          to learn how to build an application and discover more
          interesting technologies that can improve my skills.
        </Text>
      </View>

      {/* CAREER GOAL */}
      <View
        style={[
          styles.goalCard,
          { backgroundColor: colors.blue },
        ]}
      >
        <Text style={styles.goalTitle}>
          🌐 My Career Goal
        </Text>

        <Text style={styles.goalText}>
          My goal is to become a Network Engineer. I want to continue
          learning and improve my technical skills so I can build a
          successful career in the IT industry.
        </Text>
      </View>

      {/* ABOUT APP BUTTON */}
      <Pressable
        style={styles.button}
        onPress={() => router.push('/modal')}
      >
        <Text style={styles.buttonText}>
          💡 About My App
        </Text>
      </Pressable>

      <Text style={[styles.footer, { color: colors.secondary }]}>
        Application Development & Emerging Technologies
      </Text>

      <Text style={[styles.footer, { color: colors.secondary }]}>
        Created by Mark Joseph P. Catolico
      </Text>
    </ScrollView>
  );
}

function InfoRow({
  label,
  value,
  colors,
  last = false,
}: {
  label: string;
  value: string;
  colors: {
    text: string;
    secondary: string;
    border: string;
  };
  last?: boolean;
}) {
  return (
    <View
      style={[
        styles.infoRow,
        !last && {
          borderBottomWidth: 1,
          borderBottomColor: colors.border,
        },
      ]}
    >
      <Text style={[styles.infoLabel, { color: colors.secondary }]}>
        {label}
      </Text>

      <Text style={[styles.infoValue, { color: colors.text }]}>
        {value}
      </Text>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
  },

  content: {
    paddingBottom: 35,
  },

  header: {
    paddingTop: 65,
    paddingHorizontal: 22,
    paddingBottom: 30,
  },

  headerTitle: {
    color: '#FFFFFF',
    fontSize: 13,
    fontWeight: '800',
    letterSpacing: 1.5,
    marginBottom: 10,
  },

  greeting: {
    color: '#FFFFFF',
    fontSize: 30,
    fontWeight: '800',
  },

  headerSubtitle: {
    color: '#DCEEFF',
    fontSize: 14,
    marginTop: 7,
  },

  profileCard: {
    marginHorizontal: 18,
    marginTop: -5,
    padding: 24,
    alignItems: 'center',
    borderRadius: 18,
    borderWidth: 1,
    elevation: 3,
    shadowColor: '#000',
    shadowOpacity: 0.08,
    shadowRadius: 8,
    shadowOffset: {
      width: 0,
      height: 3,
    },
  },

  avatar: {
    width: 90,
    height: 90,
    borderRadius: 45,
    backgroundColor: '#1976D2',
    justifyContent: 'center',
    alignItems: 'center',
    marginBottom: 15,
  },

  avatarText: {
    color: '#FFFFFF',
    fontSize: 40,
    fontWeight: '800',
  },

  name: {
    fontSize: 22,
    fontWeight: '800',
    textAlign: 'center',
  },

  course: {
    fontSize: 14,
    textAlign: 'center',
    marginTop: 7,
    lineHeight: 20,
  },

  badge: {
    paddingHorizontal: 14,
    paddingVertical: 7,
    borderRadius: 20,
    marginTop: 13,
  },

  badgeText: {
    fontSize: 13,
    fontWeight: '700',
  },

  card: {
    marginHorizontal: 18,
    marginTop: 16,
    padding: 20,
    borderRadius: 16,
    borderWidth: 1,
  },

  cardTitle: {
    fontSize: 18,
    fontWeight: '800',
    marginBottom: 14,
  },

  description: {
    fontSize: 14,
    lineHeight: 22,
  },

  infoRow: {
    paddingVertical: 13,
  },

  infoLabel: {
    fontSize: 12,
    marginBottom: 4,
  },

  infoValue: {
    fontSize: 15,
    fontWeight: '600',
  },

  hobbyContainer: {
    flexDirection: 'row',
    gap: 10,
  },

  hobby: {
    flex: 1,
    padding: 15,
    borderRadius: 12,
    alignItems: 'center',
  },

  hobbyEmoji: {
    fontSize: 28,
    marginBottom: 7,
  },

  hobbyText: {
    fontSize: 13,
    fontWeight: '700',
  },

  goalCard: {
    marginHorizontal: 18,
    marginTop: 16,
    padding: 22,
    borderRadius: 16,
  },

  goalTitle: {
    color: '#FFFFFF',
    fontSize: 19,
    fontWeight: '800',
    marginBottom: 10,
  },

  goalText: {
    color: '#FFFFFF',
    fontSize: 14,
    lineHeight: 22,
  },

  button: {
    marginHorizontal: 18,
    marginTop: 18,
    backgroundColor: '#172033',
    paddingVertical: 15,
    borderRadius: 12,
    alignItems: 'center',
  },

  buttonText: {
    color: '#FFFFFF',
    fontSize: 15,
    fontWeight: '700',
  },

  footer: {
    textAlign: 'center',
    fontSize: 12,
    marginTop: 18,
    marginHorizontal: 20,
  },
});

