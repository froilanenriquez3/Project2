<template>
  <div id="helpBoxDiv">

        <div class="card">
          <div class="card-header">English Helpbox</div>

          <div class="card-body">
            <div id="questionsDiv">
              <ul>
                <li v-for="(question, index) in questions" :key="index">
                  <p>{{ question.questionText }}</p>
                  <button class="btn btn-primary" id="playAudio" @click="playAudio(question.id)"><i class="fas fa-volume-up"></i></button>
                  <audio :src=" '../audio/' + question.id  + '.m4a' " :id=" 'audio' + question.id " ></audio>
                  <button class="btn btn-primary"
                    v-show="!qShowA[index]"
                    id="showButton"
                    @click="showQuestionAnswers(index)">
                    See answers
                  </button>
                  <button class="btn btn-primary"
                    v-show="qShowA[index]"
                    id="hideButton"
                    @click="hideQuestionAnswers(index)">
                    Hide answers
                  </button>

                  <div id="answersDiv" v-show="qShowA[index]">
                    <ul v-for="answer in question.answers" :key="answer.id">
                      <li>{{ answer.answerText }}</li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>

  </div>
</template>

<script>
export default {
  data() {
    return {
      questions: [],
      qShowA: [],
      answers: [],
      //   question: {
      //     text: "",
      //     answers: [],
      //   }
    };
  },
  methods: {
    showQuestionAnswers(index) {
        let me = this;
      Vue.set(me.qShowA, index, true);
    },
    hideQuestionAnswers(index) {
          let me = this;
        Vue.set(me.qShowA, index, false);
    },
    getQuestions() {
      let me = this;
      axios
        .get("/questions")
        .then((response) => {
          //console.log(response.data);
          me.questions = response.data;
          me.setShowAnswers();
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
    getAnswers(){
        let me = this;
      axios
        .get("/answers")
        .then((response) => {
          console.log(response.data);
          me.answers = response.data;
          me.setShowAnswers();
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
    setShowAnswers() {
      let me = this;
      for (let i in me.questions) {
        me.questions[i].showAnswers = false;
        me.qShowA.push(false);
      }
    },
    playAudio(id){
        document.querySelector('#audio' + id).play();
    }

  },

  mounted() {
    console.log("Component mounted.");
    this.getQuestions();

    },
};
</script>
