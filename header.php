<html>
    <head>
    <title>Bings' Chllin</title>
    <form>
        <div id="header">
          <table>
            <tr>
                <td>
                    <img src="Bingslogo.png" alt="Bings' Chillin Logo">
                </td>
                <td style="text-align: center; padding-right: 100px; width:100%;">
                    <h1>Good Morning&nbsp;<?php if (isset($_COOKIE["user"])? $_COOKIE['user']:''){echo $_COOKIE["user"];}?>! Want Some Bings Chllin?</h1>
                </td>
            </tr>
          </table>
        </div>
        </form>
    </head>
    <body>
    <div id="nav">
      <ul>
        <li><a href="Home.php">All Products</a></li>
        <li><a href="Cartlist.php">Cart</a></li>
        <li><a href="Record.php">Record</a></li>
        <li><a href="LoginCreate.php">Log Out</a></li>
      </ul>
    </div>
    </body>
</html>