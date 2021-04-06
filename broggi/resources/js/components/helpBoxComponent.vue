<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">English Helpbox</div>

          <div class="card-body">
            <div id="questionsDiv">
              <ul>
                <li  v-for="(question, index) in questions" :key="index">
                    {{ question.id }}
                    {{ question.showAnswers }}
                  <p>{{ question.questionText }}</p>

                  <button v-show="!question.showAnswers" id="showButton" @click="showQuestionAnswers(index)">
                    See answers
                  </button>
                  <button v-show="question.showAnswers" id="hideButton" @click="hideQuestionAnswers(index)" >
                    Hide answers
                  </button>

                  <div id="answersDiv" v-show="question.showAnswers">
                    <ul v-for="answer in question.answers" :key="answer.id">
                      <li>{{ answer }}</li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </div>
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
    //   question: {
    //     text: "",
    //     answers: [],
    //   },
    };
  },
  methods: {
    showQuestionAnswers(id) {
        console.log("Show answers");
    //   id -= 1;
        console.log(this.questions[id].showAnswers);
      this.questions[id].showAnswers = true;
      console.log(this.questions[id].showAnswers);
    },
    hideQuestionAnswers(id) {
    //   id -= 1;

      this.questions[id].showAnswers = false;
    },
    getQuestions() {
      let me = this;
      axios
        .get("/questions")
        .then((response) => {
          console.log(response.data);
          me.questions = response.data;
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
      }
    },

  },

  mounted() {
    console.log("Component mounted.");
    this.getQuestions();

  },
};
</script>
