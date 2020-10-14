<template>
   <div class="card">
      <form class="form-horizontal"  @submit.prevent="submit">
         <div class="card-body">
            <h4 class="card-title">New Quiz</h4>
            
            <div class="form-group row">
               <label for="fname" class="col-md-2 ">Title</label>
               <div class="col-md-10">
                  <input type="text"  class="form-control" id="title" name="title" placeholder="title">
                  <div class="invalid-feedback" >Example invalid custom file feedback</div>
               </div>
               <div class="valid-feedback"> Please provide a valid state. </div>
            </div>


            <div class="form-group row">
               <label for="fname" class="col-md-2 this.choices">Body</label>
               <div class="col-md-10">
                  <input type="text"  class="form-control" id="body" name="body" placeholder="body">
                  <div class="invalid-feedback" >Example invalid custom file feedback</div>
               </div>
               <div class="valid-feedback"> Please provide a valid state. </div>
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
                                                id="customControlAutosizing1">
                                            <label class="custom-control-label" for="customControlAutosizing1">Publish</label>
                                        </div>
                                    </div>
                                </div>



            <div class="form-group row">
               <div class="col-sm-3"> </div>
               <div class="col-sm-9" >
                  <button type="button"  class="w-100 p-1 btn btn-outline-primary"> <i class="m-r-5 fas fa-plus-circle"></i> Add a choice</button> 
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