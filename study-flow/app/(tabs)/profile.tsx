import { useState } from "react";
import {
  Alert,
  Pressable,
  ScrollView,
  StyleSheet,
  Text,
  TextInput,
  View,
} from "react-native";

export default function ProfileScreen() {
  const [name, setName] = useState("Student");
  const [email, setEmail] = useState("student@example.com");
  const [course, setCourse] = useState("BS Information Technology");

  const [saved, setSaved] = useState(true);

  const saveProfile = () => {
    if (!name.trim() || !email.trim() || !course.trim()) {
      Alert.alert(
        "Incomplete Profile",
        "Please fill in all fields before saving."
      );
      return;
    }

    if (!email.includes("@")) {
      Alert.alert(
        "Invalid Email",
        "Please enter a valid email address."
      );
      return;
    }

    setSaved(true);

    Alert.alert(
      "Profile Saved",
      "Your profile has been updated successfully."
    );
  };

  const handleNameChange = (text: string) => {
    setName(text);
    setSaved(false);
  };

  const handleEmailChange = (text: string) => {
    setEmail(text);
    setSaved(false);
  };

  const handleCourseChange = (text: string) => {
    setCourse(text);
    setSaved(false);
  };

  const firstLetter = name.trim()
    ? name.trim().charAt(0).toUpperCase()
    : "?";

  return (
    <ScrollView
      style={styles.container}
      contentContainerStyle={styles.content}
      keyboardShouldPersistTaps="handled"
    >
      {/* Avatar */}
      <View style={styles.avatar}>
        <Text style={styles.avatarText}>{firstLetter}</Text>
      </View>

      <Text style={styles.heading}>My Profile</Text>

      <Text style={styles.subtitle}>
        Manage your personal information
      </Text>

      {/* Name */}
      <Text style={styles.label}>Name</Text>

      <TextInput
        value={name}
        onChangeText={handleNameChange}
        placeholder="Enter your name"
        placeholderTextColor="#999999"
        style={styles.input}
      />

      {/* Email */}
      <Text style={styles.label}>Email</Text>

      <TextInput
        value={email}
        onChangeText={handleEmailChange}
        placeholder="Enter your email"
        placeholderTextColor="#999999"
        keyboardType="email-address"
        autoCapitalize="none"
        style={styles.input}
      />

      {/* Course */}
      <Text style={styles.label}>Course</Text>

      <TextInput
        value={course}
        onChangeText={handleCourseChange}
        placeholder="Enter your course"
        placeholderTextColor="#999999"
        style={styles.input}
      />

      {/* Save Button */}
      <Pressable
        style={({ pressed }) => [
          styles.button,
          pressed && styles.pressed,
        ]}
        onPress={saveProfile}
      >
        <Text style={styles.buttonText}>Save Profile</Text>
      </Pressable>

      {/* Save Status */}
      <View style={[styles.statusBox, saved ? styles.savedBox : styles.unsavedBox]}>
        <Text style={saved ? styles.savedText : styles.unsavedText}>
          {saved
            ? "✓ Profile saved successfully"
            : "● You have unsaved changes"}
        </Text>
      </View>

      {/* Current Information */}
      <View style={styles.infoCard}>
        <Text style={styles.infoTitle}>Profile Information</Text>

        <View style={styles.infoRow}>
          <Text style={styles.infoLabel}>Name</Text>
          <Text style={styles.infoValue}>{name}</Text>
        </View>

        <View style={styles.infoRow}>
          <Text style={styles.infoLabel}>Email</Text>
          <Text style={styles.infoValue}>{email}</Text>
        </View>

        <View style={styles.infoRow}>
          <Text style={styles.infoLabel}>Course</Text>
          <Text style={styles.infoValue}>{course}</Text>
        </View>
      </View>
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: "#F5F7FB",
  },

  content: {
    padding: 22,
    paddingBottom: 50,
  },

  avatar: {
    width: 90,
    height: 90,
    borderRadius: 45,
    backgroundColor: "#4F46E5",
    justifyContent: "center",
    alignItems: "center",
    alignSelf: "center",
    marginTop: 10,
    marginBottom: 15,
  },

  avatarText: {
    color: "#FFFFFF",
    fontSize: 36,
    fontWeight: "bold",
  },

  heading: {
    fontSize: 28,
    fontWeight: "bold",
    color: "#222222",
    textAlign: "center",
  },

  subtitle: {
    fontSize: 14,
    color: "#777777",
    textAlign: "center",
    marginTop: 6,
    marginBottom: 25,
  },

  label: {
    fontSize: 14,
    fontWeight: "bold",
    color: "#555555",
    marginBottom: 7,
    marginTop: 12,
  },

  input: {
    backgroundColor: "#FFFFFF",
    borderWidth: 1,
    borderColor: "#DDDDDD",
    borderRadius: 10,
    paddingHorizontal: 14,
    paddingVertical: 13,
    fontSize: 16,
    color: "#222222",
  },

  button: {
    backgroundColor: "#4F46E5",
    paddingVertical: 15,
    borderRadius: 10,
    alignItems: "center",
    marginTop: 28,
  },

  pressed: {
    opacity: 0.7,
  },

  buttonText: {
    color: "#FFFFFF",
    fontSize: 16,
    fontWeight: "bold",
  },

  statusBox: {
    marginTop: 15,
    padding: 12,
    borderRadius: 10,
    alignItems: "center",
  },

  savedBox: {
    backgroundColor: "#DCFCE7",
  },

  unsavedBox: {
    backgroundColor: "#FEF3C7",
  },

  savedText: {
    color: "#166534",
    fontSize: 14,
    fontWeight: "600",
  },

  unsavedText: {
    color: "#92400E",
    fontSize: 14,
    fontWeight: "600",
  },

  infoCard: {
    backgroundColor: "#FFFFFF",
    borderRadius: 12,
    padding: 18,
    marginTop: 25,
    borderWidth: 1,
    borderColor: "#E5E7EB",
  },

  infoTitle: {
    fontSize: 18,
    fontWeight: "bold",
    color: "#222222",
    marginBottom: 15,
  },

  infoRow: {
    paddingVertical: 10,
    borderBottomWidth: 1,
    borderBottomColor: "#EEEEEE",
  },

  infoLabel: {
    fontSize: 12,
    color: "#777777",
    marginBottom: 3,
  },

  infoValue: {
    fontSize: 16,
    color: "#222222",
    fontWeight: "500",
  },
});