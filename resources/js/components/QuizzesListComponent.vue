<template>
     <div class="card">
                            <div class="card-body">
                                <h5 class="card-title m-b-0">Static Table</h5>
                            
                            <table id="cssTable" class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <td  style="text-align: center; vertical-align: middle;" class="text-center">Title</td>
                                        <td  style="text-align: center; vertical-align: middle;" class="text-center">Body</td>
                                         <td  style="text-align: center; vertical-align: middle;" class="text-center">Publish</td>
                                        <td  style="text-align: center; vertical-align: middle;" class="text-center">Module</td>
                                         <td  style="text-align: center; vertical-align: middle;" class="text-center">Views Count</td>
                                        <td  style="text-align: center; vertical-align: middle;" class="text-center">Updated At</td>
                                        <th  style="text-align: center; vertical-align: middle;" scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row" class="text-center">1</th>
                                        <td class="text-center">Title</td>
                                        <td class="text-center">Body</td>
                                         <td class="text-center">Publish</td>
                                         <td class="text-center">Module</td>
                                        <td class="text-center">Updated At</td>
                                        <td class="text-center">
                                        
                                        <button type="button" class="btn btn-outline-primary"><i class="m-r-3 fas fa-trash-alt"></i>  </button>
                                        <button type="button" class="btn btn-outline-danger"> <i class="m-r-3 fas fa-ban"></i>  </button>
                                        <button type="submit" class="btn btn-outline-success"><i class="m-r-3 fas fa-save"></i> </button>
                

                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-center">1</th>
                                        <td class="text-center">Mark</td>
                                        <td class="text-center">Otto</td>
                                         <td class="text-center">Mark</td>
                                        <td class="text-center">Otto</td>
                                         <td class="text-center">Mark</td>
                                        <td class="text-center">
                                        
                                        <button type="button" class="btn btn-outline-primary"><i class="m-r-3 fas fa-trash-alt"></i>  </button>
                                        <button type="button" class="btn btn-outline-danger"> <i class="m-r-3 fas fa-ban"></i>  </button>
                                        <button type="submit" class="btn btn-outline-success"><i class="m-r-3 fas fa-save"></i> </button>
                

                                        </td>
                                    </tr>
                                     <tr>
                                        <th scope="row" class="text-center">1</th>
                                        <td class="text-center">Mark</td>
                                        <td class="text-center">Otto</td>
                                         <td class="text-center">Mark</td>
                                        <td class="text-center">Otto</td>
                                         <td class="text-center">Mark</td>
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