<template>
    <div class="card">
        <form class="form-horizontal" @submit.prevent="save">
            <div class="card-body">
                <h4 class="card-title">{{ componentTitle }}</h4>
                <div class="form-group row">
                    <label for="fname" class="col-md-2">Title</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" v-model="quiz.title" name="title" placeholder="title" />
                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                    </div> 
                    <div class="valid-feedback">Please provide a valid state.</div>
                </div>
                <div class="form-group row">
                    <label for="fname" class="col-md-2 this.choices">Body</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" v-model="quiz.body" name="body" placeholder="body" />
                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                    </div>
                    <div class="valid-feedback">Please provide a valid state.</div>
                </div>
                <div class="form-group row">
                    <label for="fname" class="col-md-2 this.choices">Views count </label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" v-model="quiz.views_count" name="views_count" disabled="false" />
                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                    </div>
                    <div class="valid-feedback">Please provide a valid state.</div>
                </div>
                <div class="form-group row">
                    <label for="fname" class="col-md-2 this.choices">Votes count</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" v-model="quiz.votes_count" name="votes_count" disabled="false" />
                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                    </div>
                    <div class="valid-feedback">Please provide a valid state.</div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2">Module</label>
                    <div class="col-md-10">
                        <select class="select2 form-control" v-model="moduleId" v-on:change="onChangeModule($event)" style="height: 36px; width: 100%;">
                            <option v-for="module in modules" :key="module.id" :value="module.id"> {{ module.title }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fname" class="col-md-2">File Upload</label>
                    <div class="col-md-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" @change="selectFile" name="file" />
                            <label class="custom-file-label" for="file">Choose file...</label>
                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2">Options</label>
                    <div class="col-md-10">
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="customControlAutosizing1" v-model="quiz.publish" />
                            <label class="custom-control-label" for="customControlAutosizing1">Publish</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2">Time</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" v-model="quiz.time" id="time" />
                    </div>
                </div>
            </div>
            <div class="border-top">
                <div class="card-body">
                    <button type="submit" class="btn btn-success" @submit.prevent=""><i class="m-r-5 fas fa-save"></i>Save</button>
                    <button type="button" class="btn btn-primary">X</button>
                    <button type="button" class="btn btn-info"><i class="m-r-5 fas fa-edit"></i>Edit</button>
                    <button type="button" class="btn btn-danger" @click="cancel"><i class="m-r-5 fas fa-window-close"></i> Cancel</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
    export default {
        name: "quiz-component",

        data() {
            return {
                isEditing: false,
                cachedQuiz: {},
                moduleId: null,
                modules: [],
                quiz: {
                    id: null,
                    title: "",
                    body: "",
                    file : null,
                    publish: true,
                    views_count: null,
                    votes_count: null,
                },
            };
        },
        computed: {
            componentTitle: function () {
                return this.isEditing ? "Edit Quiz" : "New Quiz";
            },
        },
        created() {
            this.isEditing ? (this.quiz.id = 1) : null;
        },

        mounted() {
            this.fetchModules().then((result) => {
                if (this.isEditing) {
                    this.fetchQuiz();
                    console.log(this.quiz);
                }
            });
        },

        methods: {

            selectFile(event) {
                this.quiz.file = event.target.files[0];
            },


            save() {
                if (this.isEditing) {
                    this.update();
                } else this.submit();
            },

            restoreFromCache() {
                this.quiz = Object.assign({}, this.cachedQuiz);
            },

            cancel() {
                if (this.isEditing) {
                    this.restoreFromCache();
                }
            },
            onChangeModule(e) {
                this.moduleId = e.target.value;
            },

            submit() {

                const formData = new FormData();
                
                for ( var key in this.quiz) {
                    formData.append(key, this.quiz[key]); 
                }

                axios.post(`/api/v1/modules/${this.moduleId}/quizzes`, formData)
                    .catch((error) => {
                        console.log("Error");
                    })
                    .then(({ data }) => {
                        console.log("the quiz has been created");
                    });
            },
            update() {
                axios
                    .put(`api/v1/modules/${this.moduleId}/quizzes/${this.quiz.id}`, this.quiz)
                    .catch((error) => {
                        console.log("Error");
                    })
                    .then(({ data }) => {
                        console.log("the quiz has been updated");
                        this.cachedQuiz = Object.assign({}, this.quiz);
                    });
            },
            fetchModules() {
                return axios
                    .get(`api/v1/modules`)
                    .catch((error) => {
                        console.log("Error");
                    })
                    .then(({ data }) => {
                        console.log("fetch module");
                        this.modules = data.quizzes;
                        this.modules[0] != null && this.moduleId == null ? (this.moduleId = this.modules[0].id) : null;
                    });
            },
            fetchQuiz() {
                axios
                    .get(`api/v1/quizzes/${this.quiz.id}`)
                    .catch((error) => {
                        console.log("Error");
                    })
                    .then(({ data }) => {
                        this.quiz = data.quiz;
                        this.cachedQuiz = Object.assign({}, data.quiz);
                        this.moduleId = this.quiz.module_id;
                    });
            },
        },
    };
</script>
