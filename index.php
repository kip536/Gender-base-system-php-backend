
<!DOCTYPE html>
<html>
    <head>
        <title>home</title>
    </head>
    <body>

        <table style="text-align: center;">
          <thead>
            <tr style="font-style:initial">
              <th>inbox_route_id</th>
              <th>msisdn</th>
              <th>shortcode</th>
              <th>net_id</th>
              <th>origin</th>
              <th>udh</th>
              <th>message</th>
              <th>status</th>
              <th>processed</th>
              <th>number_of_sends</th>
              <th>updated_time</th>
              <th>date_created</th>
              <th>partner_id</th>
              <th>priority</th>
            </tr>
          </thead>
          <tbody>
          <?php

          @include 'database.php';

          $result = mysqli_query($conn, "SELECT * from inbox_route");
              while($rows = $result -> fetch_assoc()) {
                echo "
                <tr>
                  <td>$rows[inbox_route_id]</td>
                  <td>$rows[msisdn]</td>
                  <td>$rows[shortcode]</td>
                  <td>$rows[net_id]</td>
                  <td>$rows[origin]</td>
                  <td>$rows[udh]</td>
                  <td>$rows[message]</td>
                  <td>$rows[status]</td>
                  <td>$rows[processed]</td>
                  <td>$rows[number_of_sends]</td>
                  <td>$rows[updated_time]</td>
                  <td>$rows[date_created]</td>
                  <td>$rows[partner_id]</td>
                  <td>$rows[priority]</td>
                </tr>
                ";
              }

          ?>

                 
           
            
          </tbody>
        </table>
    </body>
</html>