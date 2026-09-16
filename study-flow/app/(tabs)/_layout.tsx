import { Tabs } from "expo-router";

export default function TabsLayout() {
  return (
    <Tabs
    
      screenOptions={{
        headerShown: false,
        tabBarActiveTintColor: "#2563EB",
        tabBarInactiveTintColor: "#64748B",
      }}
      >


      
      <Tabs.Screen
        name="index"
        options={{
          title: "Dashboard",
          
        }}
      />

      <Tabs.Screen
        name="tasks"
        options={{
          title: "Tasks",
        }}
      />

      <Tabs.Screen
        name="profile"
        options={{
          title: "Profile",
        }}
      />
    </Tabs>
  );
}