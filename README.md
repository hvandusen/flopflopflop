# flopflopflop

One button that drops you into a random spot in the [jammers](https://soundcloud.com/hvandusen/sets/jammers) playlist. Longer tracks are proportionally more likely to be picked, so every second of the playlist has the same chance. There's also a play/pause button.

The playlist is set in the iframe in `public/index.html`. The logic is in `public/flop.js`.

## Run

```sh
npm install
cp .env.example .env   # set PORT
npm start
```
