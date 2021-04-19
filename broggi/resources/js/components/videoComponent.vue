<template>
  <div id="videoDiv">
    <div class="card">
      <div class="card-header">Videos Broggi</div>

      <div class="card-body row align-items-center">
        <video muted id="myVideo" width="320" height="240" class="col-12">
          <source
            src="http://localhost:8080/Project2/broggi/public/video/videosBroggi.mp4"
            type="video/mp4"
          />
          Your browser does not support the video tag.
        </video>
        <p id="videoProgress"></p>
        <div class="row align-items-center ml-4">
            <button v-if="action == 'play'" class="btn btn-primary m-1" id="playButton">
                <i class="fas fa-play"></i> Play
            </button>

            <button class="btn btn-primary m-1" id="section1">Section 1</button>
            <button class="btn btn-primary m-1" id="section2">Section 2</button>
            <button class="btn btn-primary m-1" id="section3">Section 3</button>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      videoId: "#myVideo",
      action: "play",
      timestamp: 0,
      section1time: 0,
      section2time: 233,
      section3time: 311,
    };
  },
  methods: {
    playVideo() {
      let videoElem = document.querySelector(this.videoId);
      if (videoElem.paused) videoElem.play();

      document.querySelector(
        "#playButton"
      ).innerHTML = `<i class="fas fa-pause"></i> Pause`;
      document
        .querySelector("#playButton")
        .removeEventListener("click", this.playVideo);
      document
        .querySelector("#playButton")
        .addEventListener("click", this.pauseVideo);
    },
    pauseVideo() {
      let videoElem = document.querySelector(this.videoId);
      videoElem.pause();

      document.querySelector(
        "#playButton"
      ).innerHTML = `<i class="fas fa-play"></i> Play`;
      document
        .querySelector("#playButton")
        .removeEventListener("click", this.pauseVideo);
      document
        .querySelector("#playButton")
        .addEventListener("click", this.playVideo);
    },
    skipTen() {
      let videoElem = document.querySelector(this.videoId);
      videoElem.currentTime += 10;
    },
    rewindTen() {
      let videoElem = document.querySelector(this.videoId);
      videoElem.currentTime -= 10;
    },
    setTimestamp() {
      let videoElem = document.querySelector(this.videoId);
      videoElem.currentTime = this.timestamp;
    },
    videoEventHandler() {
      console.log("Video event handler");
      let videoElem = document.querySelector(this.videoId);
      videoElem.addEventListener("timeupdate", this.pauseAtTimestamp);
    },
    pauseAtTimestamp() {
      let videoElem = document.querySelector(this.videoId);
      //If you dont want video to pause from fast fowarding, remove greater than
      if (videoElem.currentTime >= this.timestamp) {
        videoElem.pause();
        videoElem.removeEventListener("timeupdate", this.pauseAtTimestamp);
      }
    },
    displayProgress() {
      let videoElem = document.querySelector(this.videoId);
      // vLength = videoElem.duration;
      document.querySelector("#videoProgress").innerHTML =
        "The video is at timestamp: " +
        Math.floor(
          videoElem.currentTime
        ) /* videoElem.currentTime.toFixed(2) */;
    },

    playSection1() {
      let videoElem = document.querySelector(this.videoId);
      videoElem.currentTime = this.section1time;
      this.playVideo();
      this.timestamp = this.section2time;
      videoElem.addEventListener("timeupdate", this.pauseAtTimestamp);
    },
    playSection2() {
      let videoElem = document.querySelector(this.videoId);
      videoElem.currentTime = this.section2time;
      this.playVideo();
      this.timestamp = this.section3time;
      videoElem.addEventListener("timeupdate", this.pauseAtTimestamp);
    },
    playSection3() {
      let videoElem = document.querySelector(this.videoId);
      videoElem.currentTime = this.section3time;
      this.playVideo();
      this.timestamp = videoElem.duration;
      videoElem.addEventListener("timeupdate", this.pauseAtTimestamp);
    },
    highlightSection() {
      let videoElem = document.querySelector(this.videoId);
      if (videoElem.currentTime < this.section2time) {
        document.querySelector("#section1").style.backgroundColor = "red";
        document.querySelector("#section2").style.backgroundColor = "#11ADC4";
        document.querySelector("#section3").style.backgroundColor = "#11ADC4";
      } else if (videoElem.currentTime < this.section3time) {
        document.querySelector("#section2").style.backgroundColor = "red";
        document.querySelector("#section1").style.backgroundColor = "#11ADC4";
        document.querySelector("#section3").style.backgroundColor = "#11ADC4";
      } else {
        document.querySelector("#section3").style.backgroundColor = "red";
        document.querySelector("#section1").style.backgroundColor = "#11ADC4";
        document.querySelector("#section2").style.backgroundColor = "#11ADC4";
      }
    },
  },
  created() {},
  mounted() {
    // console.log("Component mounted.");
    //this.playVideo();

    document.querySelector("#myVideo").setAttribute("controls", "true");

    document
      .querySelector("#playButton")
      .addEventListener("click", this.playVideo);

    document
      .querySelector("#section1")
      .addEventListener("click", this.playSection1);

    document
      .querySelector("#section2")
      .addEventListener("click", this.playSection2);

    document
      .querySelector("#section3")
      .addEventListener("click", this.playSection3);

    document
      .querySelector("#myVideo")
      .addEventListener("timeupdate", this.highlightSection);

    //setInterval(this.displayProgress, 1000);
  },
};
</script>
