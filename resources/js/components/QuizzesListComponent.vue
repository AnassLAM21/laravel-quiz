<template>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title m-b-0">Quizzes List </h5>
            <table id="cssTable" class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th class="text-center">Title</th>

                        <th class="text-center">Publish</th>
                        <th class="text-center">Module</th>
                        <th class="text-center">Views Count</th>
                        <th class="text-center">Created By</th>
                        <th class="text-center">Created At</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(quiz,index) in quizzes" v-bind="quiz" :key="quiz.id" :index="index">
                        <td scope="row" class="text-center">{{ quiz.title }}</td>

                        <td class="text-center">{{ quiz.publish }}</td>
                        <td class="text-center">{{ quiz.module.title }}</td>
                        <td class="text-center">{{ quiz.views_count }}</td>
                        <td class="text-center">{{ quiz.user.name }}</td>
                        <td class="text-center">{{ quiz.created_at }}</td>

                        <td class="text-center">
                            <button type="button" class="btn btn-outline-danger"><i class="m-r-3 fas fa-trash-alt"></i></button>
                            <button type="button" class="btn btn-outline-primary"><i class="m-r-3 fas fa-eye"></i></button>
                            <button type="button" class="btn btn-outline-warning"><i class="m-r-3 fas fa-copy"></i></button>
                            <button type="submit" class="btn btn-outline-success"><i class="m-r-3 fas fa-edit"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>


            <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchQuizzes(pagination.prev_page_url)">Previous</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchQuizzes(pagination.next_page_url)">Next</a></li>
      </ul>
    </nav>


        </div>
    </div>
</template>
<script>
    export default {
        name: "quiz-component",
        data() {
            return {
                quizzes: [],
                pagination: {},

            };
        },
        created() {
            this.fetchQuizzes();
        },
        methods: {
            fetchQuizzes(page_url) {

                let vm = this;
                 page_url = page_url || 'api/v1/quizzes';

                axios
                    .get(page_url)
                    .catch((error) => {
                        console.log("Error");
                    })
                    .then(({ data }) => {
                        this.quizzes = data.quizzes;

                        console.log(data.meta);
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

<style>
    td {
        width: 10px;
        padding:0 0 10px 0; 
    }
    th{
        font-weight: bold;
    }
    #cssTable td {
        text-align: center;
        vertical-align: middle;
        text-align: center;
        vertical-align: middle;
    }
    button {
        margin-top:2px;
    }
</style> 