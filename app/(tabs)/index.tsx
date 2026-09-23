import React, { useEffect, useState } from 'react';
import {
  ActivityIndicator,
  Pressable,
  SafeAreaView,
  ScrollView,
  StyleSheet,
  Text,
  View,
} from 'react-native';

type Quote = {
  id: number;
  quote: string;
  author: string;
};

const API_URL = 'https://dummyjson.com/quotes/random';

export default function HomeScreen() {
  const [quote, setQuote] = useState<Quote | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');

  async function fetchQuote() {
    try {
      setLoading(true);
      setError('');

      const response = await fetch(API_URL);

      if (!response.ok) {
        throw new Error(
          `Request failed with status ${response.status}`
        );
      }

      const data: Quote = await response.json();

      if (!data.quote || !data.author) {
        throw new Error('The API returned an empty quote.');
      }

      setQuote(data);
    } catch (error) {
      console.error('Quote request error:', error);

      setQuote(null);

      setError(
        'Unable to load a quote. Please check your internet connection and try again.'
      );
    } finally {
      setLoading(false);
    }
  }

  useEffect(() => {
    fetchQuote();
  }, []);

  function handleNewQuote() {
    fetchQuote();
  }

  return (
    <SafeAreaView style={styles.safeArea}>
      <ScrollView
        contentContainerStyle={styles.scrollContainer}
      >
        <View style={styles.container}>

          <Text style={styles.title}>
            QUOTES APP
          </Text>

          <Text style={styles.subtitle}>
            Discover a new quote
          </Text>

          <View style={styles.card}>

            <Text style={styles.cardTitle}>
              QUOTE OF THE DAY
            </Text>

            {/* LOADING STATE */}
            {loading && (
              <View style={styles.stateContainer}>
                <ActivityIndicator
                  size="large"
                  color="#FFFFFF"
                />

                <Text style={styles.loadingText}>
                  Loading quote...
                </Text>
              </View>
            )}

            {/* ERROR STATE */}
            {!loading && error !== '' && (
              <View style={styles.stateContainer}>
                <Text style={styles.errorTitle}>
                  Unable to Load Quote
                </Text>

                <Text style={styles.errorText}>
                  {error}
                </Text>
              </View>
            )}

            {/* EMPTY STATE */}
            {!loading &&
              error === '' &&
              quote === null && (
                <View style={styles.stateContainer}>
                  <Text style={styles.emptyText}>
                    No quote available.
                  </Text>
                </View>
              )}

            {/* SUCCESS STATE */}
            {!loading &&
              error === '' &&
              quote !== null && (
                <View style={styles.quoteContainer}>
                  <Text style={styles.quoteText}>
                    "{quote.quote}"
                  </Text>

                  <Text style={styles.authorText}>
                    — {quote.author}
                  </Text>
                </View>
              )}

            {/* NEW QUOTE BUTTON */}
            <Pressable
              onPress={handleNewQuote}
              disabled={loading}
              style={({ pressed }) => [
                styles.button,
                pressed && styles.buttonPressed,
                loading && styles.buttonDisabled,
              ]}
            >
              <Text style={styles.buttonText}>
                {loading ? 'LOADING...' : 'NEW QUOTE'}
              </Text>
            </Pressable>

          </View>

          <Text style={styles.apiText}>
            Data provided by DummyJSON Quotes API
          </Text>

        </View>
      </ScrollView>
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  safeArea: {
    flex: 1,
    backgroundColor: '#F1F5F9',
  },

  scrollContainer: {
    flexGrow: 1,
  },

  container: {
    flex: 1,
    minHeight: '100%',
    justifyContent: 'center',
    alignItems: 'center',
    paddingHorizontal: 24,
    paddingVertical: 40,
  },

  title: {
    fontSize: 30,
    fontWeight: '800',
    color: '#172554',
    letterSpacing: 1,
    marginBottom: 8,
  },

  subtitle: {
    fontSize: 16,
    color: '#64748B',
    marginBottom: 28,
  },

  card: {
    width: '100%',
    maxWidth: 420,
    minHeight: 400,
    backgroundColor: '#172554',
    borderRadius: 24,
    padding: 28,
    justifyContent: 'space-between',

    shadowColor: '#000000',
    shadowOffset: {
      width: 0,
      height: 8,
    },
    shadowOpacity: 0.2,
    shadowRadius: 12,
    elevation: 8,
  },

  cardTitle: {
    color: '#60A5FA',
    fontSize: 14,
    fontWeight: '800',
    textAlign: 'center',
    letterSpacing: 1,
  },

  quoteContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    paddingHorizontal: 4,
  },

  quoteText: {
    color: '#FFFFFF',
    fontSize: 25,
    lineHeight: 36,
    fontWeight: '700',
    textAlign: 'center',
  },

  authorText: {
    color: '#BFDBFE',
    fontSize: 16,
    fontWeight: '600',
    textAlign: 'center',
    marginTop: 22,
  },

  stateContainer: {
    flex: 1,
    minHeight: 230,
    justifyContent: 'center',
    alignItems: 'center',
    paddingHorizontal: 10,
  },

  loadingText: {
    color: '#FFFFFF',
    fontSize: 16,
    marginTop: 16,
  },

  errorTitle: {
    color: '#FCA5A5',
    fontSize: 20,
    fontWeight: '800',
    textAlign: 'center',
    marginBottom: 12,
  },

  errorText: {
    color: '#E2E8F0',
    fontSize: 14,
    lineHeight: 21,
    textAlign: 'center',
  },

  emptyText: {
    color: '#FFFFFF',
    fontSize: 16,
    textAlign: 'center',
  },

  button: {
    backgroundColor: '#38BDF8',
    borderRadius: 30,
    paddingVertical: 15,
    paddingHorizontal: 30,
    alignItems: 'center',
    marginTop: 25,
  },

  buttonPressed: {
    opacity: 0.7,
  },

  buttonDisabled: {
    opacity: 0.6,
  },

  buttonText: {
    color: '#082F49',
    fontSize: 15,
    fontWeight: '900',
    letterSpacing: 0.5,
  },

  apiText: {
    color: '#94A3B8',
    fontSize: 12,
    marginTop: 22,
    textAlign: 'center',
  },
});