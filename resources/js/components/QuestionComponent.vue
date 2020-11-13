<template>
    <div class="card">
        <form class="form-horizontal" @submit.prevent="submit">
            <div class="card-body">
                <h4 class="card-title">New question</h4>

                <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Body</label>
                    <div class="col-sm-9">
                        <input type="text" :class="{'is-invalid': validation.hasError('questionBody')}" v-model="questionBody" class="form-control" id="body" name="body" placeholder="body" />
                        <div class="invalid-feedback" :class="{'d-block': validation.hasError('questionBody')}">Example invalid custom file feedback</div>
                    </div>
                    <div class="valid-feedback">Please provide a valid state.</div>
                </div>
                <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">File Upload</label>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file" />
                            <label class="custom-file-label" for="file">Choose file...</label>
                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                        </div>
                    </div>
                </div>

                <div class="form-group row" v-for="(choice,index) in choices" v-bind="choice" :key="choice.id" :index="index">
                    <label for="lname" class="col-3 col-sm-3 text-right control-label col-form-label">Choice {{ index + 1 }} </label>
                    <div class="col-12 col-sm-5">
                        <input type="text" @keyup="changeChoice()" class="form-control" v-model="choice.body" name="choice" placeholder="choice" />
                    </div>
                    <div class="form-check">
                        <input type="radio" :checked="choice.id  == choices[index].is_right_choice" @change="checkChoices(index)" class="form-check-input" :id="'' + index +''" />
                        <label class="" :for="'' + index + ''">Right</label>
                    </div>
                    <div class="text-right col-12 col-sm-2">
                        <button @click="deleteChoices(index)" type="button" class="btn btn-outline-danger"><i class="m-r-5 fas fa-trash-alt"></i> Delete</button>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        <button type="button" @click="newChoice" class="w-100 p-1 btn btn-outline-primary"><i class="m-r-5 fas fa-plus-circle"></i> Add a choice</button>
                    </div>
                </div>
            </div>
            <div class="border-top">
                <div class="card-body">
                    <button type="submit" class="btn btn-success" @submit.prevent="submit()"><i class="m-r-5 fas fa-save"></i>Save</button>
                    <button type="button" class="btn btn-primary">X</button>
                    <button type="button" class="btn btn-info"><i class="m-r-5 fas fa-edit"></i>Edit</button>
                    <button type="button" class="btn btn-danger" @click="resetFrom"><i class="m-r-5 fas fa-window-close"></i> Cancel</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
    import SimpleVueValidation from "simple-vue-validator";
    const Validator = SimpleVueValidation.Validator;
    Vue.use(SimpleVueValidation);

    export default {
        name: "question-new",
        data() {
            return {
                quizId: 1,
                questionBody: "",
                choiceId: 1,
                question: { body: "", id: null },
                choices1: [],
                choices: [],
            };
        },

        create() {},

        beforeMount() {},

        async mounted() {
            await this.retrieveChoices();

            this.questionBody = this.question.body;
            if (this.highestChoiceId !== undefined) {
                this.choiceId = this.highestChoiceId + 1;
            }

            while (this.choices.length < 4) {
                this.choices.push({
                    id: this.choiceId++,
                    body: "",
                    is_right_choice: false,
                });
            }

            for (let index = 0; index < this.choices.length; index++) {
                if (this.choices[index].id == this.question.right_choice_id) {
                    this.choices[index].is_right_choice = true;
                } else this.choices[index].is_right_choice = false;
            }

            let arr = this.choices;
            this.choices = [];

            this.choices = arr;
        },

        validators: {
            //  questionBody : function (value) {
            //     return Validator.value(value).required();
            // },
            // choices: function (value) {
            //    return Validator.value(value).required();
            // }
        },

        computed: {
            check() {},

            highestChoiceId() {
                if (this.choices.length == 0) return;
                return (this.choiceId = this.choices.reduce((a, b) => (Number(a.choice) > Number(b.choice) ? a : b)).id);
            },
        },
        methods: {
            changeChoice(index, id, choiceBody, choiceIs_right_choice) {
                this.choices[index] = { id: id, body: choiceBody, is_right_choice: choiceIs_right_choice };

                //this.choiceId++;
            },
            resetFrom() {
                for (let index = 0; index < this.choices.length; index++) {
                    const choice = this.choices[index];

                    if (this.question.right_choice_id == choice.id) {
                        choice.is_right_choice == true;
                    }

                    this.choice2.push({
                        body: choice.body,
                        is_right_choice: choice.is_right_choice,
                    });
                }
            },
            deleteChoices(deletedIndex) {
                this.choices.splice(deletedIndex, 1);
            },

            checkChoices(checkedIndex) {
                console.log("Checked" + checkedIndex);

                this.choices.forEach((choice, index) => {
                    if (index == checkedIndex) {
                        choice.is_right_choice = !choice.is_right_choice;
                    } else choice.is_right_choice = false;
                });
            },
            newChoice() {
                this.choiceId++;
                this.choices.push({
                    id: this.choiceId,
                    body: "",
                    is_right_choice: false,
                });
            },

            submit() {
                return this.$validate().then(
                    function (success) {
                        if (success) {
                            this.createQuestion();
                        }
                    }.bind(this)
                );
            },
            createQuestion() {
                axios
                    .post(`/api/v1/quizzes/${this.quizId}/questions`, {
                        body: this.questionBody,
                    })
                    .catch((error) => {
                        console.log("Error");
                    })
                    .then(({ data }) => {
                        this.question.id = data.question.id;

                        for (let index = 0; index < this.choices.length; index++) {
                            const choice = this.choices[index];
                            if (choice.body != "") {
                                this.createChoice(choice);
                            }
                        }
                    });
            },

            createChoice(choice) {
                axios
                    .post(`/api/v1/questions/${this.question.id}/choices`, {
                        body: choice.body,
                        is_right_choice: true,
                    })
                    .catch((error) => {
                        console.log("Error");
                    })
                    .then(({ data }) => {
                        console.log("the choices has been created");
                    });
            },

            async retrieveChoices() {
                await axios
                    .get(`/api/v1/questions/${this.quizId}`)

                    .catch((error) => {
                        console.log("Error");
                    })
                    .then(({ data }) => {
                        this.question = data.question;
                        this.choices = data.question.choices;

                        console.log(this.choices);
                    });
            },
        },
    };
</script>
