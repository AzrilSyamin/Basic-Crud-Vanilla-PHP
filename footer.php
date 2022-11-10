</main>
<footer>

</footer>
<script src="asset/js/bootstrap.bundle.min.js"></script>
<script>
  let mylink = window.location.pathname
  let path = mylink.split("/")
  const fileUrl = window.location.protocol + "//" + window.location.host + "/" + path[1] + "/"


  // menu active 
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
  // end menu active 

  // checbox
  let checkAll = document.querySelector("#select_all")
  let checks = document.querySelectorAll(".check")

  checkAll.onclick = function() {
    if (checkAll.checked == true) {
      checks.forEach(element => {
        element.checked = true
      })
    } else {
      checks.forEach(element => {
        element.checked = false
      })
    }
  }

  for (let i = 0; i < checks.length; i++) {
    checks[i].onclick = function() {
      let result = 0
      for (let i = 0; i < checks.length; i++) {
        if (checks[i].checked) result++
      }
      checkAll.checked = result === checks.length
    }
  }
  // end checbox
</script>
</body>

</html>