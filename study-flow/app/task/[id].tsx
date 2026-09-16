import {
    useLocalSearchParams,
    useRouter,
  } from "expo-router";
  
  import {
    Pressable,
    SafeAreaView,
    ScrollView,
    StyleSheet,
    Text,
    View,
  } from "react-native";
  
  import { useState } from "react";
  
  type Task = {
    id: string;
    title: string;
    subject: string;
    dueDate: string;
    status: "Pending" | "Completed";
  };
  
  const tasks: Task[] = [
    {
      id: "1",
      title: "CCE 106 Assignment",
      subject: "cce 106",
      dueDate: "September 18",
      status: "Pending",
    },
    {
      id: "2",
      title: "Proposal",
      subject: "IT 12",
      dueDate: "September 19",
      status: "Completed",
    },
    {
      id: "3",
      title: "Drop and Drag Assignment",
      subject: "IT 13",
      dueDate: "September 20",
      status: "Pending",
    },
    {
      id: "4",
      title: "Programming Activity",
      subject: "Introduction to Programming",
      dueDate: "September 21",
      status: "Completed",
    },
    {
      id: "5",
      title: "History Presentation",
      subject: "History",
      dueDate: "September 22",
      status: "Pending",
    },
    {
      id: "6",
      title: "Research Paper",
      subject: "Research",
      dueDate: "September 24",
      status: "Completed",
    },
  ];
  
  export default function TaskDetailsScreen() {
    const router = useRouter();
  
    const { id } = useLocalSearchParams<{
      id: string;
    }>();
  
    const task = tasks.find(
      (item) => item.id === id
    );
  
    const [status, setStatus] = useState<
      "Pending" | "Completed"
    >(task?.status ?? "Pending");
  
    if (!task) {
      return (
        <SafeAreaView style={styles.container}>
          <View style={styles.errorContainer}>
            <Text style={styles.errorTitle}>
              Task Not Found
            </Text>
  
            <Text style={styles.errorText}>
              The task with ID "{id}" does not exist.
            </Text>
  
            <Pressable
              onPress={() => router.back()}
              style={({ pressed }) => [
                styles.button,
                pressed && styles.pressed,
              ]}
            >
              <Text style={styles.buttonText}>
                Go Back
              </Text>
            </Pressable>
          </View>
        </SafeAreaView>
      );
    }
  
    const toggleStatus = () => {
      setStatus((current) =>
        current === "Pending"
          ? "Completed"
          : "Pending"
      );
    };
  
    return (
      <SafeAreaView style={styles.container}>
        <ScrollView
          contentContainerStyle={styles.content}
        >
          <Text style={styles.heading}>
            Task Details
          </Text>
  
          <View style={styles.card}>
            <Text style={styles.title}>
              {task.title}
            </Text>
  
            <Text style={styles.label}>
              Subject
            </Text>
  
            <Text style={styles.value}>
              {task.subject}
            </Text>
  
            <Text style={styles.label}>
              Due Date
            </Text>
  
            <Text style={styles.value}>
              {task.dueDate}
            </Text>
  
            <Text style={styles.label}>
              Status
            </Text>
  
            <View
              style={[
                styles.status,
                status === "Completed"
                  ? styles.completed
                  : styles.pending,
              ]}
            >
              <Text style={styles.statusText}>
                {status}
              </Text>
            </View>
  
            <Pressable
              onPress={toggleStatus}
              style={({ pressed }) => [
                styles.button,
                pressed && styles.pressed,
              ]}
            >
              <Text style={styles.buttonText}>
                {status === "Pending"
                  ? "Mark as Completed"
                  : "Mark as Pending"}
              </Text>
            </Pressable>
  
            <Pressable
              onPress={() => router.back()}
              style={({ pressed }) => [
                styles.backButton,
                pressed && styles.pressed,
              ]}
            >
              <Text style={styles.backButtonText}>
                Go Back
              </Text>
            </Pressable>
          </View>
        </ScrollView>
      </SafeAreaView>
    );
  }
  
  const styles = StyleSheet.create({
    container: {
      flex: 1,
      backgroundColor: "#f4f7fb",
    },
  
    content: {
      padding: 20,
    },
  
    heading: {
      fontSize: 28,
      fontWeight: "800",
      color: "#222",
      marginBottom: 20,
    },
  
    card: {
      backgroundColor: "#fff",
      padding: 22,
      borderRadius: 16,
      elevation: 3,
      shadowColor: "#000",
      shadowOpacity: 0.1,
      shadowRadius: 5,
      shadowOffset: {
        width: 0,
        height: 2,
      },
    },
  
    title: {
      fontSize: 24,
      fontWeight: "800",
      color: "#2563eb",
      marginBottom: 25,
    },
  
    label: {
      fontSize: 13,
      fontWeight: "700",
      color: "#777",
      marginTop: 15,
      textTransform: "uppercase",
    },
  
    value: {
      fontSize: 17,
      color: "#222",
      marginTop: 5,
    },
  
    status: {
      alignSelf: "flex-start",
      marginTop: 8,
      paddingHorizontal: 14,
      paddingVertical: 8,
      borderRadius: 20,
    },
  
    pending: {
      backgroundColor: "#fef3c7",
    },
  
    completed: {
      backgroundColor: "#dcfce7",
    },
  
    statusText: {
      fontWeight: "700",
    },
  
    button: {
      backgroundColor: "#2563eb",
      padding: 15,
      borderRadius: 12,
      alignItems: "center",
      marginTop: 30,
    },
  
    buttonText: {
      color: "#fff",
      fontWeight: "700",
      fontSize: 15,
    },
  
    backButton: {
      borderWidth: 1,
      borderColor: "#2563eb",
      padding: 15,
      borderRadius: 12,
      alignItems: "center",
      marginTop: 12,
    },
  
    backButtonText: {
      color: "#2563eb",
      fontWeight: "700",
    },
  
    pressed: {
      opacity: 0.65,
    },
  
    errorContainer: {
      flex: 1,
      justifyContent: "center",
      alignItems: "center",
      padding: 30,
    },
  
    errorTitle: {
      fontSize: 26,
      fontWeight: "800",
      color: "#dc2626",
    },
  
    errorText: {
      marginTop: 10,
      color: "#666",
      textAlign: "center",
      fontSize: 16,
    },
  });