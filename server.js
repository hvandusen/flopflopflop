const path = require('path');

// Load .env from this folder, however the app is started (npm start, pm2, node).
try {
  process.loadEnvFile(path.join(__dirname, '.env'));
} catch {}
const express = require('express');

const PORT = process.env.PORT || 3000;
const app = express();

app.use(express.static(path.join(__dirname, 'public')));
app.use((req, res) => res.status(404).send('Not found'));

app.listen(PORT, () => console.log(`flopflopflop listening on http://localhost:${PORT}`));
