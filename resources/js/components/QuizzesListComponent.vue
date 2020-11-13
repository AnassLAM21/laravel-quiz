<template>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title m-b-0">Quizzes List </h5>
            <table id="cssTable" class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <td class="text-center">Title</td>

                        <td class="text-center">Publish</td>
                        <td class="text-center">Module</td>
                        <td class="text-center">Views Count</td>
                        <td class="text-center">Created By</td>
                        <td class="text-center">Created At</td>
                        <td class="text-center">Action</td>
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
        </div>
    </div>
</template>
<script>
    export default {
        name: "quiz-component",

        data() {
            return {
                quizzes: [],
            };
        },

        created() {
            console.log(this.fetchModules());
        },

        methods: {
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
        },
    };
</script>

<style>
    td {
        height: 50px;
        width: 50px;
    }

    #cssTable td {
        text-align: center;
        vertical-align: middle;
        text-align: center;
        vertical-align: middle;
    }

    button {
        margin-top:3px;
    }

</style> 
