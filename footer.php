</main>
<footer>

</footer>
<script src="asset/js/bootstrap.bundle.min.js"></script>
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

  let mylink = window.location.pathname
  let path = mylink.split("/")
  const fileUrl = window.location.protocol + "//" + window.location.host + "/" + path[1] + "/"

  if (window.location.href == fileUrl + "index.php") {
    document.querySelector("thead tr th:last-child").classList.add("visually-hidden")
    let mat = document.querySelectorAll("tbody tr td:last-child")
    for (i = 0; i < mat.length; i++) {
      mat[i].classList.add("visually-hidden")
    }
  }

  let title = document.querySelectorAll(".nav-link")
  let mytitle = path[2].split(".")
  if (mytitle[0] == "index" || mytitle[0] == "") {
    title[0].classList.add("active")
  } else {
    for (i = 0; i < title.length; i++) {
      if (mytitle[0].charAt(0).toUpperCase() + mytitle[0].slice(1) == title[i].innerHTML) {
        title[i].classList.add("active")
      } else {
        title[i].classList.remove("active")
      }
    }
  }
</script>
</body>

</html>