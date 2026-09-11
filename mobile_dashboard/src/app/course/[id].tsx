import { useLocalSearchParams, useRouter } from 'expo-router';
import {
    SafeAreaView,
    StyleSheet,
    Text,
    TouchableOpacity,
    View,
} from 'react-native';

const courses: Record<
  string,
  {
    name: string;
    description: string;
  }
> = {
  '101': {
    name: 'CCE 106 - Application Development',
    description:
      'A course focused on developing applications using modern programming technologies.',
  },

  '102': {
    name: 'Computer Programming',
    description:
      'A course covering programming concepts, problem solving, and application development.',
  },
};

export default function CourseDetailsScreen() {
  const { id } = useLocalSearchParams<{ id: string }>();
  const router = useRouter();

  const courseId = Array.isArray(id) ? id[0] : id;
  const course = courseId ? courses[courseId] : undefined;

  if (!course) {
    return (
      <SafeAreaView style={styles.safeArea}>
        <View style={styles.container}>
          <Text style={styles.errorTitle}>
            Course Not Found
          </Text>

          <Text style={styles.errorText}>
            The course ID "{courseId}" is not valid.
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
          Course Details
        </Text>

        <View style={styles.card}>
          <Text style={styles.label}>Course ID</Text>
          <Text style={styles.value}>{courseId}</Text>

          <Text style={styles.label}>Course Name</Text>
          <Text style={styles.courseName}>
            {course.name}
          </Text>

          <Text style={styles.label}>Description</Text>
          <Text style={styles.description}>
            {course.description}
          </Text>
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
    padding: 22,
    borderWidth: 1,
    borderColor: '#E2E8F0',
  },

  label: {
    fontSize: 13,
    color: '#64748B',
    marginTop: 10,
  },

  value: {
    fontSize: 18,
    fontWeight: '700',
    color: '#2563EB',
    marginTop: 4,
  },

  courseName: {
    fontSize: 20,
    fontWeight: '700',
    color: '#0F172A',
    marginTop: 4,
  },

  description: {
    fontSize: 15,
    lineHeight: 22,
    color: '#475569',
    marginTop: 4,
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