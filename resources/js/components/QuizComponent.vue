<template>
   <div class="card">
      <form class="form-horizontal"  @submit.prevent="submit">
         <div class="card-body">
            <h4 class="card-title">New Quiz</h4>
            <div class="form-group row">
               <label for="fname" class="col-md-2 ">Title</label>
               <div class="col-md-10">
                  <input type="text"  class="form-control" v-model="quiz.title" name="title" placeholder="title">
                  <div class="invalid-feedback" >Example invalid custom file feedback</div>
               </div>
               <div class="valid-feedback"> Please provide a valid state. </div>
            </div>
            <div class="form-group row">
               <label for="fname" class="col-md-2 this.choices">Body</label>
               <div class="col-md-10">
                  <input type="text"  class="form-control" v-model="quiz.body" name="body" placeholder="body">
                  <div class="invalid-feedback" >Example invalid custom file feedback</div>
               </div>
               <div class="valid-feedback"> Please provide a valid state. </div>
            </div>
            <div class="form-group row">
               <label for="fname" class="col-md-2 this.choices">Views count </label>
               <div class="col-md-10">
                  <input type="text"  class="form-control" v-model="quiz.views_count" name="views_count" disabled="false">
                  <div class="invalid-feedback" >Example invalid custom file feedback</div>
               </div>
               <div class="valid-feedback"> Please provide a valid state. </div>
            </div>
            <div class="form-group row">
               <label for="fname" class="col-md-2 this.choices">Votes count</label>
               <div class="col-md-10">
                  <input type="text"  class="form-control" v-model="quiz.votes_count" name="votes_count" disabled="false">
                  <div class="invalid-feedback" >Example invalid custom file feedback</div>
               </div>
               <div class="valid-feedback"> Please provide a valid state. </div>
            </div>
            <div class="form-group row">
               <label class="col-md-2">Module</label>
               <div class="col-md-10">
                  <select class="select2 form-control" v-model="moduleId" v-on:change="onChangeModule($event)" style="height: 36px;width: 100%;">
                     <option v-for="module in modules" :key="module.id" :value="module.id"> {{ module.title }}</option>
                  </select>
               </div>
            </div>
            <div class="form-group row">
               <label for="fname" class="col-md-2 ">File Upload</label>
               <div class="col-md-10">
                  <div class="custom-file">
                     <input type="file" class="custom-file-input" id="file" name="file">
                     <label class="custom-file-label" for="file">Choose file...</label>
                     <div class="invalid-feedback">Example invalid custom file feedback</div>
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <label class="col-md-2 ">Options</label>
               <div class="col-md-10">
                  <div class="custom-control custom-checkbox mr-sm-2">
                     <input type="checkbox" class="custom-control-input"
                        id="customControlAutosizing1" v-model="quiz.publish">
                     <label class="custom-control-label" for="customControlAutosizing1">Publish</label>
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <label class="col-md-2">Time</label>
               <div class="col-md-10">
                  <input class="form-control" type="time" v-model="quiz.time" id="time">
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
      name : 'quiz-component',
   
      data(){
         return {

            isEditing : true,
            beforeEdit : {},
            moduleId : null,
            modules : [],
            quiz:{ quizId:null, title : '',body:'',views_count:0,votes_count:0,publish:true,time : '00:00:00'  }

         }
      },
   
      created(){ },
   
      mounted(){        
          this.fetchModules();

         if (this.isEditing) {
            this.fetchQuiz();
            this.moduleId = this.quiz.id;
         }

      },
   
       methods:{


         cancel(){

            
            if (this.isEditing) {
               this.quiz  = this.beforeEdit;
            }
         },
         onChangeModule(e){
   
            this.moduleId = e.target.value;
         },
   
         submit(){
                  // console.log(this.quiz);
                   axios.post(`/api/v1/modules/${this.moduleId}/quizzes`, this.quiz)
                   .catch(error => {
                      console.log('Error');
                   })
                   .then(({data}) => {
                      console.log("the quiz has been created");
                   })   
         },
            fetchModules(){
              axios.get(`api/v1/modules`)
                   .catch(error => {
                      console.log('Error');
                   })
                   .then(({data}) => {
                     this.modules = data.quizzes;
                     this.modules[0] != null && this.moduleId ==null ? this.moduleId = this.modules[0].id : null
                   })
         },
         fetchQuiz(){
               this.quiz.id = 1;
              axios.get(`api/v1/quizzes/${this.quiz.id}`)
                   .catch(error => {
                      console.log('Error');
                   })
                   .then(({data}) => {
                     this.quiz = data.quiz;
                     this.beforeEdit = this.quiz
              })
         },



      },
   }
</script>