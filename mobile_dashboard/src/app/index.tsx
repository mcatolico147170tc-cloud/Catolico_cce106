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
    title: 'Total Sales',
    value: '₱24,580',
    subtitle: '+12.5% this month',
    symbol: '₱',
  },
  {
    title: 'Orders',
    value: '156',
    subtitle: '+8 new today',
    symbol: '#',
  },
  {
    title: 'Customers',
    value: '89',
    subtitle: '+5 this week',
    symbol: '●',
  },
];

const activities = [
  {
    title: 'New order received',
    description: 'Order #1024 was placed',
    time: '10 minutes ago',
  },
  {
    title: 'Payment completed',
    description: 'Payment for Order #1021 confirmed',
    time: '35 minutes ago',
  },
  {
    title: 'New customer',
    description: 'A new customer registered',
    time: '1 hour ago',
  },
  {
    title: 'Order delivered',
    description: 'Order #1018 was delivered',
    time: '2 hours ago',
  },
];

const actions = [
  {
    title: 'New Order',
    symbol: '+',
  },
  {
    title: 'Customers',
    symbol: 'C',
  },
  {
    title: 'Reports',
    symbol: 'R',
  },
];

function MetricCard({
  title,
  value,
  subtitle,
  symbol,
  wide,
}: {
  title: string;
  value: string;
  subtitle: string;
  symbol: string;
  wide: boolean;
}) {
  return (
    <View style={[styles.metricCard, wide && styles.metricCardWide]}>
      <View style={styles.metricTop}>
        <View style={styles.symbolCircle}>
          <Text style={styles.symbolText}>{symbol}</Text>
        </View>

        <Text style={styles.metricTitle}>{title}</Text>
      </View>

      <Text style={styles.metricValue}>{value}</Text>
      <Text style={styles.metricSubtitle}>{subtitle}</Text>
    </View>
  );
}

function ActivityItem({
  title,
  description,
  time,
}: {
  title: string;
  description: string;
  time: string;
}) {
  return (
    <View style={styles.activityItem}>
      <View style={styles.activityDot} />

      <View style={styles.activityContent}>
        <Text style={styles.activityTitle}>{title}</Text>
        <Text style={styles.activityDescription}>{description}</Text>
        <Text style={styles.activityTime}>{time}</Text>
      </View>
    </View>
  );
}

export default function Dashboard() {
  const { width } = useWindowDimensions();

  const isWideScreen = width >= 700;

  return (
    <SafeAreaView style={styles.safeArea}>
      <ScrollView
        contentContainerStyle={styles.container}
        showsVerticalScrollIndicator={false}
      >
        {/* HEADER */}
        <View style={styles.header}>
          <View>
            <Text style={styles.greeting}>Welcome back!</Text>
            <Text style={styles.headerTitle}>Dashboard</Text>
          </View>

          <TouchableOpacity
            style={styles.profileButton}
            activeOpacity={0.7}
          >
            <Text style={styles.profileLetter}>U</Text>
          </TouchableOpacity>
        </View>

        {/* OVERVIEW */}
        <View style={styles.sectionHeader}>
          <View>
            <Text style={styles.sectionTitle}>Overview</Text>
            <Text style={styles.sectionSubtitle}>
              Here's what's happening today
            </Text>
          </View>
        </View>

        {/* METRIC CARDS */}
        <View
          style={[
            styles.metricsContainer,
            isWideScreen && styles.metricsContainerWide,
          ]}
        >
          {metrics.map((metric) => (
            <MetricCard
              key={metric.title}
              title={metric.title}
              value={metric.value}
              subtitle={metric.subtitle}
              symbol={metric.symbol}
              wide={isWideScreen}
            />
          ))}
        </View>

        {/* QUICK ACTIONS */}
        <View style={styles.section}>
          <Text style={styles.sectionTitle}>Quick Actions</Text>

          <View
            style={[
              styles.actionsContainer,
              isWideScreen && styles.actionsContainerWide,
            ]}
          >
            {actions.map((action) => (
              <TouchableOpacity
                key={action.title}
                style={[
                  styles.actionButton,
                  isWideScreen && styles.actionButtonWide,
                ]}
                activeOpacity={0.75}
              >
                <View style={styles.actionSymbol}>
                  <Text style={styles.actionSymbolText}>
                    {action.symbol}
                  </Text>
                </View>

                <Text style={styles.actionText}>{action.title}</Text>
              </TouchableOpacity>
            ))}
          </View>
        </View>

        {/* RECENT ACTIVITY */}
        <View style={styles.section}>
          <View style={styles.activityHeader}>
            <Text style={styles.sectionTitle}>Recent Activity</Text>

            <TouchableOpacity activeOpacity={0.7}>
              <Text style={styles.viewAll}>View All</Text>
            </TouchableOpacity>
          </View>

          <View style={styles.activityCard}>
            {activities.map((activity, index) => (
              <View key={activity.title}>
                <ActivityItem
                  title={activity.title}
                  description={activity.description}
                  time={activity.time}
                />

                {index !== activities.length - 1 && (
                  <View style={styles.divider} />
                )}
              </View>
            ))}
          </View>
        </View>

        {/* FOOTER */}
        <View style={styles.footer}>
          <Text style={styles.footerText}>
            Mobile Dashboard
          </Text>
          <Text style={styles.footerSubtext}>
            Dashboard overview and activity
          </Text>
        </View>
      </ScrollView>
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  safeArea: {
    flex: 1,
    backgroundColor: '#F5F7FB',
  },

  container: {
    padding: 20,
    paddingBottom: 40,
  },

  /* HEADER */
  header: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    marginBottom: 28,
  },

  greeting: {
    fontSize: 14,
    color: '#6B7280',
    marginBottom: 4,
  },

  headerTitle: {
    fontSize: 30,
    fontWeight: '700',
    color: '#111827',
  },

  profileButton: {
    width: 48,
    height: 48,
    borderRadius: 24,
    backgroundColor: '#2563EB',
    justifyContent: 'center',
    alignItems: 'center',
  },

  profileLetter: {
    color: '#FFFFFF',
    fontSize: 18,
    fontWeight: '700',
  },

  /* SECTIONS */
  section: {
    marginTop: 28,
  },

  sectionHeader: {
    marginBottom: 16,
  },

  sectionTitle: {
    fontSize: 20,
    fontWeight: '700',
    color: '#111827',
  },

  sectionSubtitle: {
    fontSize: 14,
    color: '#6B7280',
    marginTop: 4,
  },

  /* METRICS */
  metricsContainer: {
    gap: 14,
  },

  metricsContainerWide: {
    flexDirection: 'row',
    alignItems: 'stretch',
  },

  metricCard: {
    backgroundColor: '#FFFFFF',
    borderRadius: 16,
    padding: 18,
    minHeight: 150,
    shadowOpacity: 0.05,
    shadowRadius: 8,
    elevation: 2,
  },

  metricCardWide: {
    flex: 1,
  },

  metricTop: {
    flexDirection: 'row',
    alignItems: 'center',
    marginBottom: 18,
  },

  symbolCircle: {
    width: 38,
    height: 38,
    borderRadius: 19,
    backgroundColor: '#E8F0FF',
    justifyContent: 'center',
    alignItems: 'center',
    marginRight: 10,
  },

  symbolText: {
    color: '#2563EB',
    fontSize: 17,
    fontWeight: '700',
  },

  metricTitle: {
    fontSize: 14,
    color: '#6B7280',
    fontWeight: '600',
  },

  metricValue: {
    fontSize: 27,
    fontWeight: '700',
    color: '#111827',
    marginBottom: 5,
  },

  metricSubtitle: {
    fontSize: 13,
    color: '#16A34A',
    fontWeight: '500',
  },

  /* QUICK ACTIONS */
  actionsContainer: {
    marginTop: 14,
    gap: 12,
  },

  actionsContainerWide: {
    flexDirection: 'row',
  },

  actionButton: {
    backgroundColor: '#FFFFFF',
    borderRadius: 14,
    minHeight: 62,
    paddingHorizontal: 16,
    flexDirection: 'row',
    alignItems: 'center',
    borderWidth: 1,
    borderColor: '#E5E7EB',
  },

  actionButtonWide: {
    flex: 1,
  },

  actionSymbol: {
    width: 36,
    height: 36,
    borderRadius: 10,
    backgroundColor: '#2563EB',
    justifyContent: 'center',
    alignItems: 'center',
    marginRight: 12,
  },

  actionSymbolText: {
    color: '#FFFFFF',
    fontSize: 18,
    fontWeight: '700',
  },

  actionText: {
    fontSize: 15,
    fontWeight: '600',
    color: '#1F2937',
  },

  /* ACTIVITY */
  activityHeader: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    marginBottom: 14,
  },

  viewAll: {
    color: '#2563EB',
    fontSize: 14,
    fontWeight: '600',
  },

  activityCard: {
    backgroundColor: '#FFFFFF',
    borderRadius: 16,
    paddingHorizontal: 16,
    paddingVertical: 4,
    shadowOpacity: 0.05,
    shadowRadius: 8,
    elevation: 2,
  },

  activityItem: {
    flexDirection: 'row',
    paddingVertical: 16,
  },

  activityDot: {
    width: 10,
    height: 10,
    borderRadius: 5,
    backgroundColor: '#2563EB',
    marginTop: 6,
    marginRight: 13,
  },

  activityContent: {
    flex: 1,
  },

  activityTitle: {
    fontSize: 15,
    fontWeight: '600',
    color: '#111827',
    marginBottom: 3,
  },

  activityDescription: {
    fontSize: 13,
    color: '#6B7280',
    marginBottom: 4,
  },

  activityTime: {
    fontSize: 12,
    color: '#9CA3AF',
  },

  divider: {
    height: 1,
    backgroundColor: '#EEF0F3',
    marginLeft: 23,
  },

  /* FOOTER */
  footer: {
    alignItems: 'center',
    marginTop: 35,
  },

  footerText: {
    fontSize: 14,
    fontWeight: '600',
    color: '#6B7280',
  },

  footerSubtext: {
    fontSize: 12,
    color: '#9CA3AF',
    marginTop: 4,
  },
});