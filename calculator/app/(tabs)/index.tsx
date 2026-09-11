import { useState } from "react";
import { Button, Text, View } from "react-native";

export default function CounterApp() {
  const [count, setCount] = useState(0);

  const increase = () => {
    setCount(count + 1);
  };

  const decrease = () => {
    if (count > 0) {
      setCount(count - 1);
    }
  };

  return (
    <View
      style={{
        flex: 1,
        justifyContent: "center",
        alignItems: "center",
      }}
    >
      <Text style={{ fontSize: 30, marginBottom: 20 }}>
        Counter: {count}
      </Text>

      <Button title="Increase" onPress={increase} />

      <View style={{ height: 10 }} />

      <Button title="Decrease" onPress={decrease} />
    </View>
  );
}
