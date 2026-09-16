/* study-flow/components/TaskCard.tsx */
import { Pressable, StyleSheet, Text, View } from "react-native";

export type Task = {
  id: string;
  title: string;
  subject: string;
  dueDate: string;
  status: "Pending" | "Completed";
};

type TaskCardProps = {
  task: Task;
  onPress?: () => void;
};

export default function TaskCard({
  task,
  onPress,
}: TaskCardProps) {
  const completed = task.status === "Completed";

  return (
    <Pressable
      onPress={onPress}
      style={({ pressed }) => [
        styles.card,
        pressed && styles.pressed,
      ]}
    >
      <View style={styles.topRow}>
        <Text style={styles.title}>{task.title}</Text>

        <View
          style={[
            styles.status,
            completed
              ? styles.completed
              : styles.pending,
          ]}
        >
          <Text style={styles.statusText}>
            {task.status}
          </Text>
        </View>
      </View>

      <Text style={styles.subject}>
        {task.subject}
      </Text>

      <Text style={styles.due}>
        Due: {task.dueDate}
      </Text>
    </Pressable>
  );
}

const styles = StyleSheet.create({
  card: {
    backgroundColor: "#fff",
    borderRadius: 14,
    padding: 16,
    marginBottom: 12,

    elevation: 2,

    shadowColor: "#000",
    shadowOpacity: 0.08,
    shadowRadius: 4,
    shadowOffset: {
      width: 0,
      height: 2,
    },
  },

  pressed: {
    opacity: 0.7,
    transform: [{ scale: 0.98 }],
  },

  topRow: {
    flexDirection: "row",
    justifyContent: "space-between",
    alignItems: "center",
  },

  title: {
    flex: 1,
    fontSize: 17,
    fontWeight: "700",
    color: "#222",
    marginRight: 10,
  },

  subject: {
    marginTop: 8,
    fontSize: 14,
    color: "#555",
  },

  due: {
    marginTop: 6,
    fontSize: 13,
    color: "#777",
  },

  status: {
    paddingHorizontal: 10,
    paddingVertical: 5,
    borderRadius: 20,
  },

  completed: {
    backgroundColor: "#dcfce7",
  },

  pending: {
    backgroundColor: "#fef3c7",
  },

  statusText: {
    fontSize: 11,
    fontWeight: "700",
  },
});