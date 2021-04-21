<template>
  <div id="videoDiv">
    <div class="card">
      <div class="card-header">Video Broggi</div>

      <div class="card-body row align-items-center">
        <video muted class="col-12" @timeupdate="changeProgress($event)" @canplay="changeProgress($event)"
        id="myVideo" width="320" height="240">
          <source
            src="http://localhost:8080/Project2/broggi/public/video/videosBroggi.mp4"
            type="video/mp4"
          />
          El teu navegador no soporta aquest vídeo.
        </video>
        <div @click="setProgress($event)" class="progress-range">
            <div class="progress-bar"></div>
        </div>
        <p id="videoProgress"></p>
        <div class="row align-items-center ml-4">
            <button v-if="action == 'play'" class="btn btn-primary m-1" id="playButton">
                <i class="fas fa-play"></i> Play
            </button>

            <button class="btn btn-primary m-1" id="section1">Secció 1</button>
            <button class="btn btn-primary m-1" id="section2">Secció 2</button>
            <button class="btn btn-primary m-1" id="section3">Secció 3</button>
            <i id="muteIcon" @click="toggleMute" class="fas fa-volume-mute ml-2 fa-2x"></i>
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
      video: ''
    };
  },
  methods: {
    playVideo() {
      if (this.video.paused) this.video.play();

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
      this.video.pause();

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
    toggleMute(){
        let muteIcon= document.querySelector('#muteIcon');
        this.video.muted = !this.video.muted;

        muteIcon.classList.contains('fa-volume-up') ? muteIcon.classList.replace('fa-volume-up', 'fa-volume-mute')
        : muteIcon.classList.replace('fa-volume-mute', 'fa-volume-up')
    },
    skipTen() {
      this.video.currentTime += 10;
    },
    rewindTen() {
      this.video.currentTime -= 10;
    },
    setTimestamp() {
      this.video.currentTime = this.timestamp;
    },
    videoEventHandler() {
      console.log("Video event handler");
      this.video.addEventListener("timeupdate", this.pauseAtTimestamp);
    },
    pauseAtTimestamp() {
      //If you dont want video to pause from fast fowarding, remove greater than
      if (this.video.currentTime >= this.timestamp) {
        this.video.pause();
        this.video.removeEventListener("timeupdate", this.pauseAtTimestamp);
      }
    },
    displayProgress() {
      // vLength = this.video.duration;
      document.querySelector("#videoProgress").innerHTML =
        "The video is at timestamp: " +
        Math.floor(
          this.video.currentTime
        ) /* this.video.currentTime.toFixed(2) */;
    },

    playSection1() {
      this.video.currentTime = this.section1time;
      this.playVideo();
      this.timestamp = this.section2time;
      this.video.addEventListener("timeupdate", this.pauseAtTimestamp);
    },
    playSection2() {
      this.video.currentTime = this.section2time;
      this.playVideo();
      this.timestamp = this.section3time;
      this.video.addEventListener("timeupdate", this.pauseAtTimestamp);
    },
    playSection3() {
      this.video.currentTime = this.section3time;
      this.playVideo();
      this.timestamp = this.video.duration;
      this.video.addEventListener("timeupdate", this.pauseAtTimestamp);
    },
    highlightSection() {

      if (this.video.currentTime < this.section2time) {
        document.querySelector("#section1").style.backgroundColor = "#e1157b";
        document.querySelector("#section2").style.backgroundColor = "#11ADC4";
        document.querySelector("#section3").style.backgroundColor = "#11ADC4";
      } else if (this.video.currentTime < this.section3time) {
        document.querySelector("#section2").style.backgroundColor = "#e1157b";
        document.querySelector("#section1").style.backgroundColor = "#11ADC4";
        document.querySelector("#section3").style.backgroundColor = "#11ADC4";
      } else {
        document.querySelector("#section3").style.backgroundColor = "#e1157b";
        document.querySelector("#section1").style.backgroundColor = "#11ADC4";
        document.querySelector("#section2").style.backgroundColor = "#11ADC4";
      }
    },
    changeProgress(event){
        let progressBar=document.querySelector('.progress-bar');
        // Adaptamos el % de barra pintada conforme avanza el video.
        progressBar.style.width= event.target.currentTime/event.target.duration *100 + '%'
    },
    setProgress(event){
        // Dividimos el punto en el que hemos clicado entre el total del div.
        let progressRange= document.querySelector('.progress-range')
        let newTime= event.offsetX / progressRange.offsetWidth;
        let progressBar=document.querySelector('.progress-bar');
        // Cambiamos porcentaje de la barra
        progressBar.style.width= newTime * 100 + '%';
        // Cambiamos punto del video en el que estamos.
        this.video.currentTime= newTime * this.video.duration;
    }
  },
  created() {},
  mounted() {
    // console.log("Component mounted.");
    //this.playVideo();
    this.video= document.querySelector('#myVideo');

    // document.querySelector("#myVideo").setAttribute("controls", "true");

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
