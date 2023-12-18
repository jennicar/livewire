import { init } from '@sentry/browser';
import { Integrations } from '@sentry/tracing';

init({
  dsn: 'https://72bf35645b434c709378d75a1ee85c45@o25528.ingest.sentry.io/5398706',
  integrations: [new Integrations.BrowserTracing()],
  environment: window.SAV.appEnv,
  tracesSampleRate: 1.0,
  denyUrls: [
    // Chrome extensions
    /extensions\//i,
    /^chrome:\/\//i,
  ],
});
