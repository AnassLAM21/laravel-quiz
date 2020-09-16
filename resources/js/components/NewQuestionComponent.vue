<template>
   <div class="card">
      <form class="form-horizontal"  @submit.prevent="submit">
         <div class="card-body">
            <h4 class="card-title">New question</h4>
            <div class="form-group row">
               <label for="fname" class="col-sm-3 text-right control-label col-form-label">Body</label>
               <div class="col-sm-9">
                  <input type="text" :class="{'is-invalid': validation.hasError('questionBody')}" v-model="questionBody" class="form-control" id="body" name="body" placeholder="body">
                  <div class="invalid-feedback" :class="{'d-block': validation.hasError('questionBody')}">Example invalid custom file feedback</div>
               </div>
               
               <div class="valid-feedback"> Please provide a valid state. </div>
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
    
           

            <template v-for="(choice,index) in choices" >
               <new-choice-component @click="callChild" @messageFromChild="childDataReceived" :key="choice.id" :index = "index" :body = "choice.body" :is_right_choice = "choice.is_right_choice"  ref="forms"/>
               <hr>
            </template>


            <div class="form-group row">
               <div class="col-sm-3"> </div>
               <div class="col-sm-9">
                  <button type="button" @click="newChoice" class="w-100 p-1 btn btn-outline-primary"> <i class="m-r-5 fas fa-plus-circle"></i> Add a choice</button>
               </div>
            </div>
         </div>
         <div class="border-top">
            <div class="card-body">
               <button type="submit" class="btn btn-success"><i class="m-r-5 fas fa-save"></i>Save</button>
               <button type="button" class="btn btn-primary">Reset</button>
               <button type="button" class="btn btn-info"><i class="m-r-5 fas fa-edit"></i>Edit</button>
               <button type="button" class="btn btn-danger" @click="resetFrom"><i class="m-r-5 fas fa-window-close"></i> Cancel</button>
            </div>
         </div>
      </form>
   </div>
</template>
<script>
   import SimpleVueValidation from 'simple-vue-validator';
   const Validator = SimpleVueValidation.Validator;
   Vue.use(SimpleVueValidation);
   
    export default {
      name: 'question-new',
      data () {
        return {
          quizId : 1,
   
          questionBody : '',
   
          question : { body : '', id : null }, 
          choices : [{ 
             id : null ,
             body : '',
             is_right_choice :  false,
          }]
        }
      },  
   
      validators: {
          questionBody : function (value) {
             return Validator.value(value).required();
         },
         choices: function (value) {
            return Validator.value(value).required();
         }
     },
    
      methods: {

         callChild() {
            this.$refs.childRef.childMethod('Hi from parent');
         },

         childDataReceived(choiceBody,choiceIs_right_choice){
            console.log(choiceBody );

            this.choices.push({
             body : choiceBody,
             is_right_choice :  choiceIs_right_choice
          })

            console.log(this.choices.length);

         },
         resetFrom(){
            this.questionBody = String, 
            this.choices = [{
                id : Number ,
                body : String,
                is_right_choice :  Boolean,
   
            }],
            this.validation.reset();
         },
         deleteChoice(index){
            this.choices.splice(index,1);
         },
    
         checkChoice(checkedIndex){
            
    
            this.choices.forEach((choice,index) => {
    
              
               if (index == checkedIndex){ 
                   if (choice.body == "") {
                      alert('hbes');
                   }
                  choice.is_right_choice = !choice.is_right_choice;
                }
               else choice.is_right_choice = false; 
            });
   
   
   
           
            
    
         },
        newChoice(){
    
          for (let index = 0; index < this.choices.length; index++) {
             const element = this.choices[index];
          }
          
          this.choices.push({
             body : '',
             is_right_choice :  false
          })
    
        },

        submit(){


           return this.$validate()
            .then(function(success) {
               if (success) {
                  this.createQuestion();
               }
            }.bind(this));
        },
        createQuestion () {
           

           

        
         axios.post(`/api/v1/quizzes/${this.quizId}/question`, {
                   title : 'title',
                   body: this.questionBody,
                })
                .catch(error => {
                   console.log('Error');
                })
                .then(({data}) => {
                   this.question.id = data.question.id;
                   console.log("the question has been created");
    
                   for (let index = 0; index < this.choices.length; index++) {
                      const choice = this.choices[index];
                      if (choice.body != "") {
                         this.createChoice(choice);
                      }
                   }
                })
            
            
         },
          
          createChoice (choice) {
    
                axios.post(`/api/v1/question/${this.question.id}/choice`, {
                   body: choice.body,
                   is_right_choice : choice.is_right_choice,
                })
                .catch(error => {
                   console.log('Error');
                })
                .then(({data}) => {
                   console.log("the choices has been created");
   
                   console.log(choice.body + ' '+ choice.is_right_choice);
                })
          }
        
      }
}    
</script>
