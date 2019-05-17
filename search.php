<?php
      if (isset($_POST["search"])) {
        

        $rs = mysqli_query($con,"SELECT * from clinic where id = '".$_POST["search"]."';",$host);
      while ($row = mysqli_fetch_array($rs)) {
          echo "<tr>".
            "<th>".$row["id"]."</th>".
          "</tr>";
        }

       }


          ?>