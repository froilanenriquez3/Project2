<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">English Helpbox</div>

          <div class="card-body">
            <div id="questionsDiv">
              <ul v-for="question in questions" :key="question.id">

                <li>
                  <p>{{ question.text }}</p>

                   <button v-if="question.showAnswers == 'false'"
                    id="showButton"
                    @click="showQuestionAnswers(question.id)"
                  >
                    See answers
                  </button>
                  <button v-else
                    id="hideButton"
                    @click="hideQuestionAnswers(question.id)"
                  >
                    Hide answers
                  </button>

                  <div id="answersDiv" v-show="question.showAnswers == 'true'">
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
      questions: [
        {
          id: 1,
          text: "What's the location of your emergency?",
          answers: ["At my house", "At my place of work", "At my school"],
          showAnswers: "false",
        },
        {
          id: 2,
          text: "When did this happen?",
          answers: ["Five minutes ago", "One hour ago", "I don't know"],
          showAnswers: "false",
        },
        {
          id: 3,
          text: "What is your name?",
          answers: ["John", "Tom", "Henrietta"],
          showAnswers: "false",
        },
      ],
      question: {
        text: "",
        answers: [],
      },
    };
  },
  methods: {
    showQuestionAnswers(id) {
      id -= 1;

      this.questions[id].showAnswers = "true";
    },
    hideQuestionAnswers(id) {
      id -= 1;

      this.questions[id].showAnswers = "false";
    },
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
