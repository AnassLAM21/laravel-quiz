<template>
    <div class="card">
        <div class="card-body">
             <h4 class="card-title m-b-0">Quizzes List</h4>

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
                            <button type="button" class="btn btn-outline-danger btn-xs" @click="removedQuiz(quiz.id)"><i class="m-r-3 fas fa-trash-alt"></i></button>
                            <button type="button" class="btn btn-outline-primary btn-xs"><i class="m-r-3 fas fa-eye"></i></button>
                            <button type="button" class="btn btn-outline-warning btn-xs"><i class="m-r-3 fas fa-copy"></i></button>

                            <router-link :to="{ name: 'quiz',params: { id: quiz.id } }">
                                <button type="button" class="btn btn-outline-success btn-xs"><i class="m-r-3 fas fa-edit"></i></button>
                            </router-link>

                        </td>
                    </tr>
                </tbody>
            </table>


     <div class="text-xs-center" >
      <ul class="pagination justify-content-center">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchQuizzes(pagination.prev_page_url)">Previous</a></li>
        
        <li class="page-item" v-for="index in pagination.last_page" :key="index" ><a class="page-link" href="#"  @click="fetchQuizzes('api/v1/quizzes?page='+ index +'')"> {{ index }}  </a></li>

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

            removedQuiz(id){
               













this.$toast.question('Are you sure about that?', "Confirm", {
            timeout: 20000,
            close: false,
            overlay: true,
            displayMode: 'once',
            zindex: 999,
            title: 'Hey',            
            position: 'center',
            buttons: [
                ['<button><b>YES</b></button>', (instance, toast) => {
                const index = this.quizzes.findIndex((item) => item.id == id);
                this.quizzes.splice(index, 1);
                 axios.delete(`api/v1/quizzes/${id}`)
                .catch((error) => {
                    this.$toast.error(err.response.data.message, "Error", { timeout: 3000 });                
                })
                .then(({ data }) => {

                    this.$toast.success(data.message, "Success", { timeout: 2000 });
                    // this.fetchQuizzes('api/v1/quizzes?page='+ this.pagination.current_page+'');
                });
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                }, true],
                ['<button>NO</button>', function (instance, toast) {
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                }],
            ]            
            });        












            }           
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