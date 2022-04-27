  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <nav class="p-3">
    <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="logout" class="nav-link">
                  <span class="fas fa-sign-out-alt nav-icon"> <?php echo $this->lang->line('exit'); ?></span>
                  
                </a>
              </li>
            </ul>
    </nav>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
    <strong><?php echo $this->lang->line('copyright')."&copy; 2021-".date("Y")." <a href='".$this->base_url."'>".$this->lang->line('name_system')."</a>. </strong>".$this->lang->line('all_rights_reserved'); ?>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../public/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="../public/assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../public/assets/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../public/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../public/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../public/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../public/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../public/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../public/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../public/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../public/assets/plugins/jszip/jszip.min.js"></script>
<script src="../public/assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../public/assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../public/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../public/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../public/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../public/assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../public/assets/dist/js/demo.js"></script> -->
<!-- Custom JS login -->
<?php switch ($this->session->site_lang) {
  case 'spanish':
    $src="../public/assets/dist/js/business.js";
    break;

  case 'english':
    $src="../public/assets/dist/js/business_en.js";
    break;
  
  default:
    $src="../public/assets/dist/js/business_pt.js";
    break;
} 
?>
<script src="<?php echo $src; ?>"></script>

</body>
</html>