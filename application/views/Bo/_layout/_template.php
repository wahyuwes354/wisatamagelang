<!DOCTYPE html>
<!-- <html lang="en"> -->

<head>
  <?php echo @$_meta; ?>
  <title>WisataMagelang</title>
  <?php echo @$_css; ?>
</head>

<body>
  <!-- Site wrapper -->
  <!-- <div class="wrapper"> -->
  <?php echo @$_navbar; ?>

  <!-- Main Sidebar Container -->
  <?php echo @$_sidebar; ?>
  <!-- Content Wrapper. Contains page content -->
  <?php echo @$_content; ?>

  <?php echo @$_footer; ?>

  <!-- Control Sidebar -->
  <!-- <aside class="control-sidebar control-sidebar-dark"> -->
  <!-- Control sidebar content goes here -->
  <!-- </aside> -->
  <!-- /.control-sidebar -->
  <!-- </div> -->
  <!-- ./wrapper -->

  <?php echo @$_js; ?>
</body>

</html>