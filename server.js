const path = require('path');
const express = require('express');

const PORT = process.env.PORT || 3000;
const app = express();

app.use(express.static(path.join(__dirname, 'public')));
app.use((req, res) => res.status(404).send('Not found'));

app.listen(PORT, () => console.log(`flopflopflop listening on http://localhost:${PORT}`));
