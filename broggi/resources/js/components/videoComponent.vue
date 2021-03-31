<template>
  <div class="container" id="videoDiv">
      <video id="myVideo" width="320" height="240">
        <source src="" type="video/mp4">
        Your browser does not support the video tag.
    </video>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  methods: {
    playVideo(videoId) {
      let videoElem = document.querySelector(videoId);
      videoElem.play();
    },
    pauseVideo(videoId) {
      let videoElem = document.querySelector(videoId);
      videoElem.pause();
    },
    skipTen(videoId) {
      let videoElem = document.querySelector(videoId);
      videoElem.currentTime += 10;
    },
    rewindTen(videoId) {
      let videoElem = document.querySelector(videoId);
      videoElem.currentTime -= 10;
    },
    setTimestamp(videoId, timestamp) {
      let videoElem = document.querySelector(videoId);
      videoElem.currentTime = timestamp;
    },
    pauseAtTimestamp(videoId, timestamp){
        let videoElem = document.querySelector(videoId);
        videoElem.addEventListener("timeupdate",function(){
            //If you dont want video to pause from fast fowarding, remove greater than
            if(this.currentTime >= timestamp){
                this.pause();
            }
        })
    }
  },
  created() {},
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
