import React from "react";
import { View, Text, StyleSheet } from "react-native";

type StatCardProps = {
  label: string;
  value: string | number;
};

export default function StatCard({
  label,
  value,
}: StatCardProps) {
  return (
    <View style={styles.card}>
      <Text style={styles.value}>{value}</Text>
      <Text style={styles.label}>{label}</Text>
    </View>
  );
}

const styles = StyleSheet.create({
  card: {
    padding: 20,
    borderRadius: 12,
    backgroundColor: "#f1f5f9",
  },

  value: {
    fontSize: 28,
    fontWeight: "bold",
  },

  label: {
    fontSize: 16,
    marginTop: 5,
  },
});