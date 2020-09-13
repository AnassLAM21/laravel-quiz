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
            <div class="form-group row" :key="choice.id"   v-for="(choice,index) in this.choices">
               <label for="lname" class="col-3 col-sm-3 text-right control-label col-form-label">Choice {{ index + 1 }} </label>
               <div class="col-12 col-sm-5">
                  <input type="text" class="form-control" v-model="choice.body" name="choice"  placeholder="choice">
               </div>
               <div class="custom-control custom-checkbox col-12 col-sm-2">
                  <input type="checkbox" :checked="choice.is_right_choice"  @change="checkChoice(index)" class="custom-control-input" :id="'' + index +''">
                  <label class="custom-control-label" :for="'' + index + ''">Right</label>
               </div>
               <div class="text-right col-12 col-sm-2">
                  <button @click="deleteChoice(index)" type="button" class="btn btn-outline-danger"> <i class="m-r-5 fas fa-trash-alt"></i> Delete </button>
               </div>
            </div>
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
               <button type="button" class="btn btn-primary" @click="resetFrom">Reset</button>
               <button type="button" class="btn btn-info"><i class="m-r-5 fas fa-edit"></i>Edit</button>
               <button type="button" class="btn btn-danger"><i class="m-r-5 fas fa-window-close"></i> Cancel</button>
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
         question : { body : '', id : null }, 
         choices : [{ 
            id : null ,
            body : '',
            is_right_choice :  false,
         }]
       }
     },  
     methods: {
   
   
        resetFrom(){
           this.question = { id : null,body : '' }, 
           this.choices = [{
               id : null ,
               body : '',
               is_right_choice :  false,

           }];
        },
        deleteChoice(index){
           this.choices.splice(index,1);
        },
   
        checkChoice(checkedIndex){
           
   
           this.choices.forEach((choice,index) => {
   
             
              if (index == checkedIndex){ 
                  
                 choice.is_right_choice = !choice.is_right_choice;
                 console.log(index + "x x" + checkedIndex + "x x"+ choice.is_right_choice);
               }
              else choice.is_right_choice = false; 
           });



          
           
   
        },
       newChoice(){
   
   
         for (let index = 0; index < this.choices.length; index++) {
            const element = this.choices[index];
            console.log(element.body);
            console.log(element.is_right_choice);
         }
         
         this.choices.push({
            body : '',
            is_right_choice :  false
         }),
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