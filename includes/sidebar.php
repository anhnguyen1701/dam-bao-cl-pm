<?php
function generateLink($gender, $conn)
{
  $query = "SELECT * FROM product WHERE gender = '$gender' GROUP BY category ASC";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
      $sidebar_category = $row['category'];
      echo "<a href='product_list.php?g=$gender&c=$sidebar_category'>$sidebar_category</a>";
    }
  }
}
?>

<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <a href="#">About</a>
  <a href="#">Services</a>

  <button class="dropdown-btn">Nữ
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <?php
    generateLink('Nữ', $conn);
    ?>
  </div>

  <button class="dropdown-btn">Nam
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <?php
    generateLink('Nam', $conn);
    ?>
  </div>
</div>

</div>

<script>
  var dropdown = document.getElementsByClassName("dropdown-btn");
  var i;

  for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
      this.classList.toggle("active");
      var dropdownContent = this.nextElementSibling;
      if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
      } else {
        dropdownContent.style.display = "block";
      }
    });
  }
</script>