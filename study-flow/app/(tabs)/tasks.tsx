import { useRouter } from "expo-router";
import { useState } from "react";
import {
  Pressable,
  SafeAreaView,
  ScrollView,
  StyleSheet,
  Text,
  View,
} from "react-native";

import TaskCard, {
  Task,
} from "../../components/TaskCard";

const tasks: Task[] = [
  {
    id: "1",
    title: "Mathematics Assignment",
    subject: "Mathematics",
    dueDate: "September 18",
    status: "Pending",
  },
  {
    id: "2",
    title: "Science Report",
    subject: "Science",
    dueDate: "September 19",
    status: "Completed",
  },
  {
    id: "3",
    title: "English Essay",
    subject: "English",
    dueDate: "September 20",
    status: "Pending",
  },
  {
    id: "4",
    title: "Programming Activity",
    subject: "Computer Science",
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

type Filter = "All" | "Pending" | "Completed";

export default function TasksScreen() {
  const router = useRouter();

  const [filter, setFilter] = useState<Filter>("All");

  const filteredTasks =
    filter === "All"
      ? tasks
      : tasks.filter((task) => task.status === filter);

  const openTask = (id: string) => {
    router.push({
      pathname: "/task/[id]",
      params: {
        id,
      },
    });
  };

  return (
    <SafeAreaView style={styles.container}>
      <ScrollView contentContainerStyle={styles.content}>
        <Text style={styles.title}>My Tasks</Text>

        <Text style={styles.subtitle}>
          Filter your tasks by status.
        </Text>

        <View style={styles.filterRow}>
          {(["All", "Pending", "Completed"] as Filter[]).map(
            (item) => (
              <Pressable
                key={item}
                onPress={() => setFilter(item)}
                style={({ pressed }) => [
                  styles.filterButton,
                  filter === item && styles.activeFilter,
                  pressed && styles.pressed,
                ]}
              >
                <Text
                  style={[
                    styles.filterText,
                    filter === item &&
                      styles.activeFilterText,
                  ]}
                >
                  {item}
                </Text>
              </Pressable>
            )
          )}
        </View>

        <View style={styles.list}>
          {filteredTasks.map((task) => (
            <TaskCard
              key={task.id}
              task={task}
              onPress={() => openTask(task.id)}
            />
          ))}
        </View>

        {filteredTasks.length === 0 && (
          <View style={styles.empty}>
            <Text style={styles.emptyText}>
              No tasks found.
            </Text>
          </View>
        )}
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

  title: {
    fontSize: 30,
    fontWeight: "800",
    color: "#222",
  },

  subtitle: {
    marginTop: 5,
    color: "#666",
    fontSize: 15,
  },

  filterRow: {
    flexDirection: "row",
    flexWrap: "wrap",
    gap: 8,
    marginTop: 20,
    marginBottom: 20,
  },

  filterButton: {
    paddingHorizontal: 16,
    paddingVertical: 9,
    borderRadius: 20,
    backgroundColor: "#e5e7eb",
  },

  activeFilter: {
    backgroundColor: "#2563eb",
  },

  filterText: {
    color: "#333",
    fontWeight: "600",
  },

  activeFilterText: {
    color: "#fff",
  },

  pressed: {
    opacity: 0.65,
  },

  list: {
    marginTop: 5,
  },

  empty: {
    padding: 30,
    alignItems: "center",
  },

  emptyText: {
    color: "#777",
    fontSize: 16,
  },
});