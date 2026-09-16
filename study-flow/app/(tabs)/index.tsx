import React from "react";
import {
  View,
  Text,
  StyleSheet,
  Pressable,
} from "react-native";
import { Link } from "expo-router";

import StatCard from "../../components/StatCard";

export default function Dashboard() {
  return (
    <View style={styles.container}>
      <Text style={styles.title}>StudyFlow</Text>

      <Text style={styles.welcome}>
        Welcome, Student!
      </Text>

      <View style={styles.cards}>
        <StatCard label="Total Tasks" value="6" />
        <StatCard label="Completed" value="3" />
        <StatCard label="Pending" value="3" />
      </View>

      {/* Correct: /tasks, NOT /(tabs)/tasks */}
      <Link href="/tasks" asChild>
        <Pressable style={styles.button}>
          <Text style={styles.buttonText}>
            View My Tasks
          </Text>
        </Pressable>
      </Link>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    padding: 20,
    backgroundColor: "#fff",
  },

  title: {
    fontSize: 30,
    fontWeight: "bold",
    marginTop: 20,
    marginBottom: 8,
  },

  welcome: {
    fontSize: 18,
    marginBottom: 25,
  },

  cards: {
    gap: 12,
    marginBottom: 30,
  },

  button: {
    backgroundColor: "#2563eb",
    padding: 15,
    borderRadius: 10,
    alignItems: "center",
  },

  buttonText: {
    color: "#fff",
    fontSize: 16,
    fontWeight: "bold",
  },
});