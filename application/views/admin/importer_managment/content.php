<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <a href="<?php echo base_url();?>Admin/Importer_add" class="float-right btn btn-info text-white"> Add Importer</a>
                    <h4 class="page-title m-0">Importer List</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
   <div class="col-12">
       <div class="card m-b-30">

           <div class="card-body">
            <div class="row  justify-content-center">
              <div class="col-md-5 m-b-20">
                <h3 class="text-center">Product Category</h3>
                 <select class="js-states form-control" name="categoryId" id="categoryId" data-live-search="true">
                    <option value="0">All</option>
                     <?php
                        foreach ($data as $key_category => $item_category) {
                      ?>
                       <option value="<?php echo $item_category['category_id']; ?>"><?php echo $item_category['category_title']; ?></option>
                       <?php
                         }
                       ?>
                 </select>
               </div>
            </div>
             <div id="all_category">
              <table id="empTable"  class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>City</th>
                          <th>Post date</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody></tbody>
              </table>
            </div>
             <div id="Filter_category">
              <table id="empTable2"  class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>City</th>
                          <th>Post date</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody></tbody>
              </table>
            </div>
           </div>
        </div>
    </div>
</div>
