<template>
    <div class="form-group row">
        <label for="lname" class="col-3 col-sm-3 text-right control-label col-form-label">Choice {{ index + 1 }} </label>
        <div class="col-12 col-sm-5">
            <input type="text" @keyup="messageFromChild()" class="form-control" :class="{'is-invalid': validation.hasError('choiceBody')}" v-model="choiceBody" name="choice" placeholder="choice" />
        </div>
        <div class="form-check">
            <input type="radio" :checked="check" @change="checkChoices(index)" class="form-check-input" :id="'' + index +''" />
            <label class="" :for="'' + index + ''">Right</label>
        </div>
        <div class="text-right col-12 col-sm-2">
            <button @click="deleteChoices" type="button" class="btn btn-outline-danger"><i class="m-r-5 fas fa-trash-alt"></i> Delete</button>
        </div>
    </div>
</template>
<script>
    import Vue from "vue";
    import SimpleVueValidation from "simple-vue-validator";
    const Validator = SimpleVueValidation.Validator;
    Vue.use(SimpleVueValidation);

    import eventHub from "vue";

    export default {
        name: "answer-new",
        props: ["index", "choice"],
        data: function () {
            return {
                choiceId: this.choice.id,
                choiceBody: this.choice.body,
                choiceIs_right_choice: this.choice.is_right_choice,
            };
        },
        computed: {
            check() {
                if (this.choice.is_right_choice == 1 || this.choice.is_right_choice == true) {
                    return true;
                }
                return false;
            },
        },

        mounted() {
            console.log(this.choice);
        },
        validators: {
            choiceBody: function (value) {
                return Validator.value(value).required();
            },
            choiceIs_right_choice: function (value) {
                return Validator.value(value).required().boolean();
            },
        },

        methods: {
            checkChoices(index) {
                this.$emit("checkChoice", this.index);
            },

            deleteChoices() {
                this.$emit("deleteChoice", this.index);
                console.log(this.choice.is_right_choice);
            },

            messageFromChild() {
                this.$emit("messageFromChild", this.index, this.choiceId, this.choiceBody, this.choiceIs_right_choice);
            },
            validate: function () {
                return this.$validate().then(
                    function (success) {
                        if (success) {
                            return { body: this.body, is_right_choice: this.is_right_choice };
                        }
                    }.bind(this)
                );
            },
            reset: function () {
                this.validation.reset();
            },
        },
    };
</script>

<style>
    .form-check {
        top: 5px;
    }
</style>
