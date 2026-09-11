import { Link, useRouter } from 'expo-router';
import {
    SafeAreaView,
    ScrollView,
    StyleSheet,
    Text,
    TouchableOpacity,
    useWindowDimensions,
    View,
} from 'react-native';

const metrics = [
  {
    title: 'Student ID',
    value: '147170',
    subtitle: '3rd Year Student',
    symbol: '#',
  },
  {
    title: 'Student Name',
    value: 'Mark Joseph',
    subtitle: 'P. Catolico',
    symbol: '●',
  },
  {
    title: 'Year Level',
    value: '3rd Year',
    subtitle: 'Currently Enrolled',
    symbol: '✓',
  },
];

export default function Dashboard() {
  const router = useRouter();
  const { width } = useWindowDimensions();

  const isWideScreen = width >= 700;

  return (
    <SafeAreaView style={styles.safeArea}>
      <ScrollView contentContainerStyle={styles.container}>
        {/* Header */}
        <View style={styles.header}>
          <View>
            <Text style={styles.welcome}>Welcome back!</Text>
            <Text style={styles.name}>Mark Joseph P. Catolico</Text>
            <Text style={styles.studentId}>Student ID: 147170</Text>
          </View>

          <TouchableOpacity
            style={styles.profileButton}
            onPress={() => router.push('/profile')}
          >
            <Text style={styles.profileButtonText}>Profile</Text>
          </TouchableOpacity>
        </View>

        {/* Dashboard Title */}
        <View style={styles.titleSection}>
          <Text style={styles.title}>Student Dashboard</Text>
          <Text style={styles.subtitle}>
            Manage your student information and courses.
          </Text>
        </View>

        {/* Metrics */}
        <View
          style={[
            styles.metricsContainer,
            isWideScreen && styles.metricsWide,
          ]}
        >
          {metrics.map((metric) => (
            <View key={metric.title} style={styles.metricCard}>
              <View style={styles.metricIcon}>
                <Text style={styles.metricIconText}>
                  {metric.symbol}
                </Text>
              </View>

              <Text style={styles.metricTitle}>{metric.title}</Text>
              <Text style={styles.metricValue}>{metric.value}</Text>
              <Text style={styles.metricSubtitle}>
                {metric.subtitle}
              </Text>
            </View>
          ))}
        </View>

        {/* Quick Actions */}
        <View style={styles.section}>
          <Text style={styles.sectionTitle}>Quick Actions</Text>

          <View style={styles.actions}>
            {/* Profile */}
            <TouchableOpacity
              style={styles.actionButton}
              onPress={() => router.push('/profile')}
            >
              <Text style={styles.actionTitle}>View Profile</Text>
              <Text style={styles.actionDescription}>
                View your student information
              </Text>
            </TouchableOpacity>

            {/* Programmatic Course Navigation */}
            <TouchableOpacity
              style={styles.actionButton}
              onPress={() =>
                router.push({
                  pathname: '/course/[id]',
                  params: { id: '101' },
                })
              }
            >
              <Text style={styles.actionTitle}>
                View Course 101
              </Text>
              <Text style={styles.actionDescription}>
                Open course details
              </Text>
            </TouchableOpacity>

            {/* Programmatic Student Navigation */}
            <TouchableOpacity
              style={styles.actionButton}
              onPress={() =>
                router.push({
                  pathname: '/student/[id]',
                  params: { id: '147170' },
                })
              }
            >
              <Text style={styles.actionTitle}>
                View Student
              </Text>
              <Text style={styles.actionDescription}>
                Open your student details
              </Text>
            </TouchableOpacity>
          </View>
        </View>

        {/* Link Navigation */}
        <View style={styles.section}>
          <Text style={styles.sectionTitle}>
            Course Links
          </Text>

          <Link
            href={{
              pathname: '/course/[id]',
              params: { id: '101' },
            }}
            style={styles.linkButton}
          >
            Open Course 101
          </Link>

          <Link
            href={{
              pathname: '/course/[id]',
              params: { id: '102' },
            }}
            style={styles.linkButton}
          >
            Open Course 102
          </Link>
        </View>

        {/* Student Link */}
        <View style={styles.section}>
          <Text style={styles.sectionTitle}>
            Student Links
          </Text>

          <Link
            href={{
              pathname: '/student/[id]',
              params: { id: '147170' },
            }}
            style={styles.linkButton}
          >
            Open My Student Profile
          </Link>
        </View>
      </ScrollView>
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  safeArea: {
    flex: 1,
    backgroundColor: '#F8FAFC',
  },

  container: {
    padding: 20,
    paddingBottom: 40,
  },

  header: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    marginBottom: 30,
  },

  welcome: {
    fontSize: 14,
    color: '#64748B',
  },

  name: {
    fontSize: 22,
    fontWeight: '700',
    color: '#0F172A',
    marginTop: 4,
  },

  studentId: {
    fontSize: 14,
    color: '#64748B',
    marginTop: 4,
  },

  profileButton: {
    backgroundColor: '#2563EB',
    paddingVertical: 10,
    paddingHorizontal: 16,
    borderRadius: 10,
  },

  profileButtonText: {
    color: '#FFFFFF',
    fontWeight: '600',
  },

  titleSection: {
    marginBottom: 20,
  },

  title: {
    fontSize: 28,
    fontWeight: '800',
    color: '#0F172A',
  },

  subtitle: {
    fontSize: 15,
    color: '#64748B',
    marginTop: 6,
  },

  metricsContainer: {
    gap: 15,
  },

  metricsWide: {
    flexDirection: 'row',
  },

  metricCard: {
    flex: 1,
    backgroundColor: '#FFFFFF',
    padding: 18,
    borderRadius: 15,
    borderWidth: 1,
    borderColor: '#E2E8F0',
  },

  metricIcon: {
    width: 40,
    height: 40,
    borderRadius: 10,
    backgroundColor: '#EFF6FF',
    justifyContent: 'center',
    alignItems: 'center',
    marginBottom: 12,
  },

  metricIconText: {
    fontSize: 18,
    fontWeight: '700',
    color: '#2563EB',
  },

  metricTitle: {
    fontSize: 13,
    color: '#64748B',
  },

  metricValue: {
    fontSize: 20,
    fontWeight: '700',
    color: '#0F172A',
    marginTop: 5,
  },

  metricSubtitle: {
    fontSize: 12,
    color: '#64748B',
    marginTop: 4,
  },

  section: {
    marginTop: 30,
  },

  sectionTitle: {
    fontSize: 20,
    fontWeight: '700',
    color: '#0F172A',
    marginBottom: 14,
  },

  actions: {
    gap: 12,
  },

  actionButton: {
    backgroundColor: '#FFFFFF',
    padding: 18,
    borderRadius: 14,
    borderWidth: 1,
    borderColor: '#E2E8F0',
  },

  actionTitle: {
    fontSize: 16,
    fontWeight: '700',
    color: '#2563EB',
  },

  actionDescription: {
    fontSize: 13,
    color: '#64748B',
    marginTop: 5,
  },

  linkButton: {
    backgroundColor: '#EFF6FF',
    padding: 15,
    borderRadius: 10,
    marginBottom: 10,
    color: '#2563EB',
    fontWeight: '600',
  },
});