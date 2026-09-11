import { useLocalSearchParams, useRouter } from 'expo-router';
import {
    SafeAreaView,
    StyleSheet,
    Text,
    TouchableOpacity,
    View,
} from 'react-native';

const students: Record<
  string,
  {
    name: string;
    year: string;
  }
> = {
  '147170': {
    name: 'Mark Joseph P. Catolico',
    year: '3rd Year',
  },
};

export default function StudentDetailsScreen() {
  const { id } = useLocalSearchParams<{ id: string }>();
  const router = useRouter();

  const studentId = Array.isArray(id) ? id[0] : id;
  const student = studentId
    ? students[studentId]
    : undefined;

  if (!student) {
    return (
      <SafeAreaView style={styles.safeArea}>
        <View style={styles.container}>
          <Text style={styles.errorTitle}>
            Student Not Found
          </Text>

          <Text style={styles.errorText}>
            The student ID "{studentId}" is not valid.
          </Text>

          <TouchableOpacity
            style={styles.button}
            onPress={() => router.back()}
          >
            <Text style={styles.buttonText}>
              Go Back
            </Text>
          </TouchableOpacity>
        </View>
      </SafeAreaView>
    );
  }

  return (
    <SafeAreaView style={styles.safeArea}>
      <View style={styles.container}>
        <Text style={styles.title}>
          Student Details
        </Text>

        <View style={styles.card}>
          <View style={styles.avatar}>
            <Text style={styles.avatarText}>MJ</Text>
          </View>

          <Text style={styles.name}>
            {student.name}
          </Text>

          <View style={styles.infoRow}>
            <Text style={styles.label}>
              Student ID
            </Text>

            <Text style={styles.value}>
              {studentId}
            </Text>
          </View>

          <View style={styles.infoRow}>
            <Text style={styles.label}>
              Year Level
            </Text>

            <Text style={styles.value}>
              {student.year}
            </Text>
          </View>
        </View>

        <TouchableOpacity
          style={styles.button}
          onPress={() => router.back()}
        >
          <Text style={styles.buttonText}>
            Back
          </Text>
        </TouchableOpacity>
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
    borderRadius: 16,
    padding: 25,
    borderWidth: 1,
    borderColor: '#E2E8F0',
    alignItems: 'center',
  },

  avatar: {
    width: 80,
    height: 80,
    borderRadius: 40,
    backgroundColor: '#2563EB',
    justifyContent: 'center',
    alignItems: 'center',
    marginBottom: 15,
  },

  avatarText: {
    color: '#FFFFFF',
    fontSize: 24,
    fontWeight: '800',
  },

  name: {
    fontSize: 21,
    fontWeight: '700',
    color: '#0F172A',
    textAlign: 'center',
    marginBottom: 20,
  },

  infoRow: {
    width: '100%',
    flexDirection: 'row',
    justifyContent: 'space-between',
    paddingVertical: 13,
    borderTopWidth: 1,
    borderTopColor: '#E2E8F0',
  },

  label: {
    color: '#64748B',
    fontSize: 14,
  },

  value: {
    color: '#0F172A',
    fontWeight: '700',
    fontSize: 14,
  },

  button: {
    backgroundColor: '#2563EB',
    padding: 16,
    borderRadius: 12,
    marginTop: 20,
  },

  buttonText: {
    color: '#FFFFFF',
    textAlign: 'center',
    fontWeight: '700',
  },

  errorTitle: {
    fontSize: 25,
    fontWeight: '800',
    color: '#DC2626',
  },

  errorText: {
    fontSize: 15,
    color: '#64748B',
    marginTop: 10,
  },
});