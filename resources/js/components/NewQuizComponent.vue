<template>
   <div class="card">
      <form class="form-horizontal"  @submit.prevent="submit">
         <div class="card-body">
            <h4 class="card-title">New Quiz</h4>
            <div class="form-group row">
               <label for="fname" class="col-md-2 ">Title</label>
               <div class="col-md-10">
                  <input type="text"  class="form-control" v-model="title" name="title" placeholder="title">
                  <div class="invalid-feedback" >Example invalid custom file feedback</div>
               </div>
               <div class="valid-feedback"> Please provide a valid state. </div>
            </div>
            <div class="form-group row">
               <label for="fname" class="col-md-2 this.choices">Body</label>
               <div class="col-md-10">
                  <input type="text"  class="form-control" v-model="body" name="body" placeholder="body">
                  <div class="invalid-feedback" >Example invalid custom file feedback</div>
               </div>
               <div class="valid-feedback"> Please provide a valid state. </div>
            </div>

            <div class="form-group row">
               <label class="col-md-2">Module</label>
               <div class="col-md-10">

                  


                  <select class="select2 form-control "   style="height: 36px;width: 100%;">
                                        
                                 
                                                <option v-for="module in modules" :key="module.id" :value="module.title">Alabama</option>
                                      
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
                        id="customControlAutosizing1" v-model="publish">
                     <label class="custom-control-label" for="customControlAutosizing1">Publish</label>
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <label class="col-md-2">Time</label>
               <div class="col-md-10">
                  <input class="form-control" type="time" v-model="time" id="example-time-input">
               </div>
            </div>
         </div>
         <div class="border-top">
            <div class="card-body">
               <button type="submit" class="btn btn-success" @submit.prevent=""><i class="m-r-5 fas fa-save"></i>Save</button>
               <button type="button" class="btn btn-primary">X</button>
               <button type="button" class="btn btn-info"><i class="m-r-5 fas fa-edit"></i>Edit</button>
               <button type="button" class="btn btn-danger" ><i class="m-r-5 fas fa-window-close"></i> Cancel</button>
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
         moduleId : 1,
         quizId : 1,
         modules : [],
         title:'123',
         body:'Body .... ',
         publish : true,
         time : '12:00:00'
      }
   },

   created(){
      this.getModules();
   },

   methods:{

      submit(){
         
         let quiz = { title : this.title , body : this.body , time : this.time , publish  : this.publish ,  title :  this.title }

         

 
                axios.post(`/api/v1/modules/${this.moduleId}/quizzes`, {
                   title : this.title , body : this.body , time : this.time , publish  : this.publish ,  title :  this.title 
                })
                .catch(error => {
                   console.log('Error');
                })
                .then(({data}) => {
                   console.log("the quiz has been created");
                })
          




      },
      getModules(){
         axios.get(`api/v1/modules`)
                .catch(error => {
                   console.log('Error');
                })
                .then(({data}) => {
                   this.modules = data.quizzes;
                })
      }

   },



}
</script>