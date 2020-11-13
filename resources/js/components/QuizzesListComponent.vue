<template>
     <div class="card">
                            <div class="card-body">
                                <h5 class="card-title m-b-0">Static Table</h5>
                            
                            <table id="cssTable" class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <td  style="text-align: center; vertical-align: middle;" class="text-center">Title</td>
                                        
                                         <td  style="text-align: center; vertical-align: middle;" class="text-center">Publish</td>
                                        <td  style="text-align: center; vertical-align: middle;" class="text-center">Module</td>
                                         <td  style="text-align: center; vertical-align: middle;" class="text-center">Views Count</td>
                                         <td  style="text-align: center; vertical-align: middle;" class="text-center">Created By</td>
                                        <td  style="text-align: center; vertical-align: middle;" class="text-center">Created At</td>
                                        <th  style="text-align: center; vertical-align: middle;" scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(quiz,index) in quizzes" v-bind="quiz" :key="quiz.id" :index = "index">
                                        <th scope="row" class="text-center"> {{ quiz.title }}</th>
                                        
                                         <td class="text-center"> {{ quiz.publish }} </td>
                                         <td class="text-center"> {{ quiz.module.title }} </td>
                                        <td class="text-center"> {{ quiz.views_count }} </td>
                                        <td class="text-center"> {{ quiz.user.name }} </td>
                                        <td class="text-center"> {{ quiz.created_at }} </td>

                                        <td class="text-center">
                                        
                                        <button type="button" class="btn btn-outline-primary"><i class="m-r-3 fas fa-trash-alt"></i>  </button>
                                        <button type="button" class="btn btn-outline-danger"> <i class="m-r-3 fas fa-ban"></i>  </button>
                                        <button type="submit" class="btn btn-outline-success"><i class="m-r-3 fas fa-save"></i> </button>
                

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </div>
</template>
<script>
    export default {
        name: "quiz-component",

         data () {
        return {
          quizzes : []
        }
      },

        created(){

            console.log("l'9lawi");



            console.log(this.fetchModules());




        },

        methods:{



            



            fetchModules() {


                 axios
                    .get(`api/v1/quizzes`)
                    .catch((error) => {
                        console.log("Error");
                    })
                    .then(({ data }) => {

                        this.quizzes = data.quizzes;
                });

            },

        }




    }
</script>

<style>

td 
{
    height: 50px; 
    width: 50px;
}

#cssTable td 
{
    text-align: center; 
    vertical-align: middle;
}

</style>