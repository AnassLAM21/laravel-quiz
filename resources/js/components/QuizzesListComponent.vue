<template>
    <div class="card">
        <div class="card-body">
             <h4 class="card-title m-b-0">Quizzes List</h4>

                <router-link :to="{ name: 'quiz' }">Quiz</router-link> |


            <table id="cssTable" class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th class="text-center" style="width:15%;">Title</th>
                        <th class="text-center" style="width:15%;">Module</th>
                        <th class="text-center" style="width:10%;">Views Count</th>
                        <th class="text-center" style="width:10%;">Vote Count</th>
                        <th class="text-center" style="width:5%;">Published</th>
                        <th class="text-center" style="width:15%;">Created By</th>
                        <th class="text-center" style="width:16%;">Created At</th>
                        <th class="text-center" style="width:14%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(quiz,index) in quizzes" v-bind="quiz" :key="quiz.id" :index="index">
                        <td scope="row" class="text-center">{{ quiz.title }}</td>

                       
                        <td class="text-center">{{ quiz.module.title }}</td>
                        <td class="text-center">{{ quiz.views_count }}</td>
                        <td class="text-center">{{ quiz.votes_count }}</td>
                         <td class="text-center">{{ quiz.publish }} </td>
                        <td class="text-center"> {{ quiz.author.name }}</td>
                        <td class="text-center">{{ quiz.created_at | moment }}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-outline-danger btn-xs"><i class="m-r-3 fas fa-trash-alt"></i></button>
                            <button type="button" class="btn btn-outline-primary btn-xs"><i class="m-r-3 fas fa-eye"></i></button>
                            <button type="button" class="btn btn-outline-warning btn-xs"><i class="m-r-3 fas fa-copy"></i></button>
                            <button type="submit" class="btn btn-outline-success btn-xs"><i class="m-r-3 fas fa-edit"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>


     <div class="text-xs-center" >
      <ul class="pagination justify-content-center">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchQuizzes(pagination.prev_page_url)">Previous</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>

    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchQuizzes(pagination.next_page_url)">Next</a></li>
      </ul>
     </div>


        </div>
    </div>
</template>
<script>
    import moment from 'moment';
    export default {
        name: "quiz-list",
        data() {
            return {
                quizzes: [],
                pagination: {},
            };
        },
        created() {
            this.fetchQuizzes();
        },
        filters: {
            moment: function (date) {
                return moment(date).format('DD-MM-Y  HH:mm:ss');
            }
        },
        methods: {
                moment: function () {
                return moment();
            },
            fetchQuizzes(page_url) {
                
                let vm = this;
                 page_url = page_url || 'api/v1/quizzes';

                axios
                    .get(page_url)
                    .catch((error) => {
                        console.log("Error");
                    })
                    .then(({ data }) => {

                         this.quizzes = data.data;

                         console.log(this.quizzes[0].author.name);
                        vm.makePagination(data.meta, data.links);
                    });
            },


            makePagination(meta, links) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            };
            this.pagination = pagination;
            },


            
        },
    };
</script>

<style lang="css">


    button {
        margin-top:1px;
    }
    #cssTable th{   
        font-weight: bold;
    }

     #cssTable td,#cssTable th{ 
        vertical-align: middle;
    }



</style> 