  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <!-- <div class="col-sm-6">
                      <h3>Content Editor</h3>
                  </div> -->
                  <!-- <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Content Editor</li>
                      </ol>
                  </div> -->
              </div>
          </div>
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <!-- left column -->
                  <div class="col-md-12">
                      <!-- general form elements -->
                      <div class="card card-primary">
                          <div class="card-header">
                              <h3 class="card-title">Add Page</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <form method="post" action="">
                              <div class="card-body">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Page Title</label>
                                      <input type="text" class="form-control" name="title" value="<?php echo $data['editdata']['title']; ?>" placeholder="Enter Title">
                                  </div>
                                  <div class="form-group">
                                      <label for="exampleInputPassword1">Page Description</label>
                                      <div class="card-body">
                                          <textarea id="summernote" input type="text" name="description" value="<?php echo $data['editdata']['description']; ?>">
                                          </textarea>
                                      </div>
                                  </div>
                              </div>
                              <!-- /.card-body -->
                              <div class="card-footer">
                                  <button type="submit" class="btn btn-primary" name="submit">Update</button>
                              </div>
                          </form>
                      </div>
                      <!-- /.card -->
                  </div>
                  <div class="form-group">
                  </div>
                  </form>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->
  </div>
  <!--/.col (right) -->
  </div>
  <!-- /.row -->
  </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- bs-custom-file-input -->
  <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- Summernote -->
  <script src="../../plugins/summernote/summernote-bs4.min.js"></script>
  <!-- Page specific script -->
  <script>
      $(function() {
          // Summernote
          // $('#summernote').summernote()

          $('#summernote').summernote({
              placeholder: 'Your text goes here..',
              tabsize: 2,
              height: 105
          });


      })
  </script>