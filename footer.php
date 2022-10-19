</main>
<footer>

</footer>
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous">
</script>
<script>
  $("#select_all").click(function() {
    if (this.checked) {
      $(".check").each(function() {
        this.checked = true
      })
    } else {
      $(".check").each(function() {
        this.checked = false
      })
    }
  })

  $(".check").click(function() {
    if ($(".check:checked").length == $(".check").length) {
      $("#select_all").prop("checked", true)
    } else {
      $("#select_all").prop("checked", false)
    }
  })
</script>
</body>

</html>