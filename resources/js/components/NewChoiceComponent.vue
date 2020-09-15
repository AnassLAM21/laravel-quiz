<template>


  <div class="form-group row" >
               <label for="lname" class="col-3 col-sm-3 text-right control-label col-form-label">Choice {{ index + 1 }} </label>
               <div class="col-12 col-sm-5">
                  <input type="text" class="form-control" :class="{'is-invalid': validation.hasError('body')}" v-model="body" name="choice"  placeholder="choice">
               </div>
               <div class="custom-control custom-checkbox col-12 col-sm-2">
                  <input type="checkbox" :checked="is_right_choice"  @change="checkChoice(index)" class="custom-control-input" :id="'' + index +''">
                  <label class="custom-control-label" :for="'' + index + ''">Right</label>
               </div>
               <div class="text-right col-12 col-sm-2">
                  <button @click="deleteChoice(index)" type="button" class="btn btn-outline-danger"> <i class="m-r-5 fas fa-trash-alt"></i> Delete </button>
               </div>
            </div>



</template>


<script>

import Vue from 'vue';
  import SimpleVueValidation from 'simple-vue-validator';
  const Validator = SimpleVueValidation.Validator;

  Vue.use(SimpleVueValidation);

  export default {
    props: ['index','body','is_right_choice'],
    data: function () {
      return {  };
    }, 
    validators: {
      body: function(value) {
        return Validator.value(value).required();
      },
      is_right_choice: function(value) {
        return Validator.value(value).required().boolean();
      }
    },
    methods: {
      validate: function() {
        return this.$validate()
          .then(function(success) {
            if (success) {
              return {body: this.body, is_right_choice: this.is_right_choice}
            }
          }.bind(this));
      },
      reset: function() {
        this.validation.reset();
      }
    }
  }


</script>