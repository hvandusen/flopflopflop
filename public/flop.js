// The flop button drops you into a random moment of the whole playlist.
// Each track's chance of being picked is proportional to its length, so every
// second of the tape is equally likely.

(function () {
  var END_BUFFER_MS = 7200; // don't land in the last few seconds of a track

  var widget = SC.Widget(document.getElementById('soundcloud_widget'));
  var flopBtn = document.getElementById('pause'); // the theme called it #pause
  var playBtn = document.getElementById('playpause');
  var volume = document.getElementById('volume');
  var FLOP_LABEL = 'Gimme somethin else doe!';

  var tracks = [];          // [{ title, duration }]
  var currentIndex = -1;
  var pendingSeek = null;   // ms to seek to once the skipped-to track starts

  // The widget loads track info a few at a time, so ask again until every
  // track has a duration (or we give up and use what we have).
  function loadTracks(attempt) {
    widget.getSounds(function (sounds) {
      var missing = sounds.filter(function (s) { return !s || !s.duration; }).length;
      if (missing && attempt < 20) {
        setTimeout(function () { loadTracks(attempt + 1); }, 500);
        return;
      }
      tracks = sounds
        .map(function (s, i) { return { index: i, title: s && s.title, duration: (s && s.duration) || 0 }; })
        .filter(function (t) { return t.duration > 0; });
      if (!tracks.length) {
        flopBtn.firstChild.textContent = 'couldn’t load the playlist';
        return;
      }
      flopBtn.firstChild.textContent = FLOP_LABEL;
      flopBtn.disabled = false;
      playBtn.disabled = false;
    });
  }

  function pickSpot() {
    var total = tracks.reduce(function (sum, t) { return sum + t.duration; }, 0);
    var r = Math.random() * total;
    for (var i = 0; i < tracks.length; i++) {
      if (r < tracks[i].duration) {
        var t = tracks[i];
        return { index: t.index, ms: Math.max(0, Math.min(r, t.duration - END_BUFFER_MS)) };
      }
      r -= tracks[i].duration;
    }
    var last = tracks[tracks.length - 1];
    return { index: last.index, ms: 0 };
  }

  // Seeking right after switching tracks sometimes gets ignored while the
  // track is still loading, so check and try again.
  function seekWhenReady(ms, attempt) {
    widget.seekTo(ms);
    setTimeout(function () {
      widget.getPosition(function (pos) {
        if (Math.abs(pos - ms) > 5000 && attempt < 5) seekWhenReady(ms, attempt + 1);
        else pendingSeek = null;
      });
    }, 700);
  }

  function setPlaying(playing) {
    var label = playing ? 'pause' : 'play';
    playBtn.querySelector('span').textContent = label;
    playBtn.querySelector('.icon').innerHTML = playing ? '&#10074;&#10074;' : '&#9654;';
    playBtn.setAttribute('aria-label', label);
  }

  flopBtn.addEventListener('click', function () {
    var spot = pickSpot();
    if (spot.index === currentIndex) {
      widget.seekTo(spot.ms);
      widget.play();
    } else {
      pendingSeek = spot.ms;
      widget.skip(spot.index);
      widget.play();
    }
  });

  playBtn.addEventListener('click', function () {
    widget.toggle();
  });

  volume.addEventListener('input', function () {
    widget.setVolume(Number(volume.value));
  });

  widget.bind(SC.Widget.Events.READY, function () {
    widget.setVolume(Number(volume.value));
    loadTracks(0);
  });

  widget.bind(SC.Widget.Events.PLAY, function () {
    setPlaying(true);
    widget.getCurrentSoundIndex(function (i) {
      currentIndex = i;
      if (pendingSeek !== null) seekWhenReady(pendingSeek, 0);
    });
  });

  widget.bind(SC.Widget.Events.PAUSE, function () { setPlaying(false); });
  widget.bind(SC.Widget.Events.FINISH, function () { setPlaying(false); });
})();

// The cowboy draws itself, line by line, over and over.
(function () {
  if (typeof Vivus === 'undefined') return;
  new Vivus('my-svg', { duration: 1000, type: 'oneByOne' }, function () {
    var self = this;
    setTimeout(function () { self.reset(); self.play(); }, 1000);
  });
})();
