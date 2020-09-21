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
    
            <!-- <template v-for="(choice,index) in choices">
               <new-choice-component @deleteChoice="x" @messageFromChild="childDataReceived" :key="choice.id" :index = "index" :choice="choice"/>
               <hr>
            </template> -->


            <!-- <new-choice-component v-for="(choice,index) in choices" :key="choice.id" :index = "index" :choice="choice" @deleteChoice="x" 
            @messageFromChild="childDataReceived" @deleteChoice="x"></new-choice-component> -->
            


            <new-choice-component @deleteChoice='x' @messageFromChild='childDataReceived' 
            v-for='(choice,index) in choices' :key='choice.id' :index = 'index' 
            :choice="choice">
            </new-choice-component>


            <!-- <todo-item v-for="todo in todosFiltered" :key="todo.id" :todo="todo" 
            :checkAll="!anyRemaining" @removedTodo="removeTodo" 
            @finishedEdit="finishedEdit"></todo-item> -->
              

            <div class="form-group row">
               <div class="col-sm-3"> </div>
               <div class="col-sm-9" >
                  <button type="button" @click="newChoice" class="w-100 p-1 btn btn-outline-primary"> <i class="m-r-5 fas fa-plus-circle"></i> Add a choice</button>
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
   import SimpleVueValidation from 'simple-vue-validator';
   const Validator = SimpleVueValidation.Validator;
   Vue.use(SimpleVueValidation);
   
    export default {
      name: 'question-new',
      data () {
        return {
          quizId : 3,
          questionBody : '',
          choiceId : 10,
          question : { body : '', id : null }, 
          choices : [{
             id : 1,
             body:'',
             is_right_choice : ''
          },
          {
             id : 2,
             body:'',
             is_right_choice : ''
          },
          {
             id : 3,
             body:'',
             is_right_choice : ''
          },
          {
             id : 4,
             body:'',
             is_right_choice : ''
          }],
        }
      },  

      mounted: function (){
            this.retrieveChoices();


      },


      validators: {
          questionBody : function (value) {
             return Validator.value(value).required();
         },
         choices: function (value) {
            return Validator.value(value).required();
         }
     },


      created() {
      },

      computed:{

         highestChoiceId(){
            if (this.choices.length == 0) return;
            return this.choiceId = this.choices.reduce((a,b) => Number(a.choice) > Number(b.choice) ? a : b).id;
    
         }


      },
      methods: {

         childDataReceived(index,choiceBody,choiceIs_right_choice){

            
            console.log(this.highestChoiceId);
            console.log(index+' '+choiceBody+' '+choiceIs_right_choice);
            this.choices[index] = { id : this.choiceId, body :  choiceBody , is_right_choice : choiceIs_right_choice };

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
         x(deletedIndex){

              this.choices.splice(deletedIndex, 1);

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
          this.choices.push({
             body : '',
             is_right_choice :  false,
          })
        },

        submit(){

           console.log(this.choices);

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
          },

           retrieveChoices () {
    
                axios.get(`/api/v1/questions/${this.quizId}/choice/`)
                .catch(error => {
                   console.log('Error');
                })
                .then(({data}) => {
                   console.log("the choices has been created");

                   console.log(data.data);

                  
                   this.choices.push(...data.data);
                })
          }


        
      }
}    
</script>
