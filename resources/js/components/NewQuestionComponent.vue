<template>
   <div class="card">
      <form class="form-horizontal"  @submit.prevent="createQuestion">
         <div class="card-body">
            <h4 class="card-title">New question</h4>
            <div class="form-group row">
               <label for="fname" class="col-sm-3 text-right control-label col-form-label">Body</label>
               <div class="col-sm-9">
                  <input type="text" v-model="question.body" class="form-control" id="body" name="body" placeholder="body">
               </div>
            </div>

            <div class="form-group row">
               <label for="fname" class="col-sm-3 text-right control-label col-form-label">File Upload</label>
               <div class="col-sm-9">
                   <div class="custom-file">
                       <input type="file" class="custom-file-input" id="file" name="file">
                            <label class="custom-file-label" for="file">Choose file...</label>
                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                    </div>
                </div>
            </div>
                                    


            <div class="form-group row" :key="choice.id" v-for="(index,choice) in this.choices.length">
               <label for="lname" class="col-sm-3 text-right control-label col-form-label">Choice {{ index }} </label>
               <div class="col-sm-7">
                  <input type="text" class="form-control" v-model="choice.body" name="choice"  placeholder="choice">
               </div>

                <div class="custom-control custom-checkbox col-sm-2">
                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing1">
                    <label class="custom-control-label" for="customControlAutosizing1">Right</label>
                </div>
            </div>


         <div class="form-group row">
              <div class="col-sm-3"> </div>
               <div class="col-sm-9">
                  <button type="button" @click="newChoice" class="w-100 p-1 btn btn-outline-primary"> <i class="fas fa-plus-circle"></i> Add a choice</button>
               </div>
            </div>

         </div>
         <div class="border-top">
            <div class="card-body">
               <button type="submit" class="btn btn-success">Save</button>
               <button type="button" class="btn btn-primary">Reset</button>
               <button type="button" class="btn btn-info">Edit</button>
               <button type="button" class="btn btn-danger">Cancel</button>
            </div>
         </div>
      </form>
   </div>
</template>
<script>
export default {
  name: 'question-new',
  data () {
    return {
      quizId : 1,
      question : { body : 'body', id : null }, 
      choice : {
         'body': '',
         'is_right_choice':  false,
      },
      choices : [
         {
            'body': 'choice body',
            'is_right_choice':  false
         }
      ]
    }
  },  
  methods: {
    newChoice(){
       this.choices.push(this.choice),
       this.choice.body = '',
       this.is_right_choice =  false,

       console.log(this.choices.length);

    },
    createQuestion () {
            axios.post(`/api/v1/quizzes/${this.quizId}/question`, {
               title : 'title',
               body: this.question.body,
            })
            .catch(error => {
               console.log('Error');
            })
            .then(({data}) => {
               this.question.id = data.question.id;
               console.log("the question has been created");
               this.createChoice();
            })
      },

      createChoice () {

            axios.post(`/api/v1/question/${this.question.id}/choice`, {
               body: this.choice.body,
               is_right_choice: this.choice.is_right_choice,
            })
            .catch(error => {
               console.log('Error');
            })
            .then(({data}) => {
               console.log("the choices has been created");
            })
      }
    
  }
}
</script>