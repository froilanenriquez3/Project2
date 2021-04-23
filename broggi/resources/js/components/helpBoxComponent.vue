<template>
  <div id="helpBoxDiv">
        <!-- div para el mensaje de error -->
        <div v-show="errorMessage !=''" class="alert alert-secondary alert-dismissible fade show" role="alert">
            <strong>Error: </strong>
            {{errorMessage}}
            <button type="button" @click="resetError()" class="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- fin del div para el mensaje de error -->
        <div class="card">
          <div class="card-header">English Helpbox</div>

          <div class="card-body">
            <div id="questionsDiv">
              <ul>
                <li v-for="(question, index) in questions" :key="index">
                  <p>{{ question.questionText }}</p>
                  <button class="btn btn-primary" id="playAudio" @click="playAudio(question.id)"><i class="fas fa-volume-up"></i></button>
                  <audio :src=" 'http://localhost:8080/Project2/broggi/public/audio/' + question.id  + '.m4a' " :id=" 'audio' + question.id " ></audio>
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
      errorMessage:'',
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
          me.errorMessage= error.response.data.error;
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
          me.errorMessage= error.response.data.error;
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
    },
    resetError(){
        this.errorMessage= '';
    }
   

  },

  mounted() {
    // console.log("Component mounted.");
    this.getQuestions();

    },
};
</script>
